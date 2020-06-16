<?php

namespace App\Modules\AdminUser\Http\Controllers;

use App\Traits\SaveTrait;
use App\Worktime;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WowrController extends Controller
{
    use SaveTrait;

    private $form = [];

    public function showItem(Request $request, $id)
    {
        $items = Worktime::where('date', 'like', $request->date . '%')->where('doctor_id', $id)->get();
        $closed = Worktime::where('date', 'like', $request->date . '%')->where('doctor_id', $id)->whereNotNull('is_holiday')->get();

        return response(['status' => 1, 'items' => $items, 'closed' => $closed->count() ? true : false]);
    }

    public function addTimes(Request $request, $id)
    {

        if (isset($request->work_time) && $request->work_time) {
            $this->form = [
                'date'      => ['required', 'date'],
                'doctor_id' => ['required', 'numeric'],
                'clinic_id' => ['required', 'numeric'],
                'start'     => ['required', 'date'],
                'end'       => ['required', 'date']
            ];


            Worktime::where('date', 'like', $request->date . '%')->where('doctor_id', $id)->whereNotNull('is_holiday')->delete();
            foreach ($request->ids as $key => $value) {
                $request->merge(['start' => $request->date . ' ' . $request->start_time[$key]]);
                $request->merge(['end' => $request->date . ' ' . $request->end_time[$key]]);
                $request->merge(['doctor_id' => $id]);
                $request->merge(['clinic_id' => $request->clinics_id[$key]]);

                if (\Carbon\Carbon::parse($request->date . $request->start_time[$key]) >= \Carbon\Carbon::parse($request->date . $request->end_time[$key])) {
                    return response(['status' => 0, 'message' => 'Початок робочого промішку повинен начинатися раніше ніж його кінець(Проміжок №' . ($key + 1) . ')']);
                }

                if (\Carbon\Carbon::createFromDate($request->date . $request->start_time[$key])->diffInMinutes($request->date . $request->end_time[$key]) < 30) {

                    return response(['status' => 0, 'message' => 'Між початком та кінцем робочого проміжку повинно бути не меньше 30 хв. (Проміжок №' . ($key + 1) . ')']);
                }

                if (count($request->ids) != $key + 1) {
                    if (\Carbon\Carbon::parse($request->date . $request->start_time[$key + 1]) < \Carbon\Carbon::parse($request->date . $request->end_time[$key])) {
                        return response(['status' => 0, 'message' => 'Доречніше вказати проміжок №' . ($key + 2) . ' в кінець проміжка №' . ($key + 1)]);
                    }

                    // Comment because not need difference more 0 minutes
//                    if (\Carbon\Carbon::createFromDate($request->date . $request->start_time[$key+1])->diffInMinutes($request->date . $request->end_time[$key]) < 30) {
//
//                        return response(['status' => 0, 'message' => 'Доречніше вказати проміжок №' . ($key + 2) . ' в кінець проміжка №' . ($key + 1)]);
//                    }
                }
            }

            Worktime::where('date', 'like', $request->date . '%')->where('doctor_id', $id)->delete();
            foreach ($request->ids as $key => $value) {
                $request->merge(['start' => $request->date . ' ' . $request->start_time[$key]]);
                $request->merge(['end' => $request->date . ' ' . $request->end_time[$key]]);
                $request->merge(['doctor_id' => $id]);
                $request->merge(['clinic_id' => $request->clinics_id[$key]]);

                $this->save(Worktime::class);
            }
        } else {
            $this->form = [
                'date'       => ['required', 'date'],
                'is_holiday' => ['required'],
                'doctor_id'  => ['required'],
            ];
            DB::transaction(function () use ($request, $id) {
                Worktime::where('date', 'like', $request->date . '%')->where('doctor_id', $id)->delete();
            });

            $request->merge(['is_holiday' => 1]);
            $request->merge(['doctor_id' => $id]);


            $this->save(Worktime::class);
        }

        return response(['status' => 1,'message' => 'Успішно додано', 'redirect' => route('editUsers', $id)]);
    }

    public function delete(Request $request, $id)
    {
        Worktime::where('id', $request->id)->where('doctor_id', $id)->delete();

        return response(['status' => 1, 'message' => 'Успішно видалено', 'redirect' => route('editUsers', $id)]);
    }
}
