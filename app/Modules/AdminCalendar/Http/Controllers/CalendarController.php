<?php

namespace App\Modules\AdminCalendar\Http\Controllers;

use App\Blacklist;
use App\Clinic;
use App\Patient;
use App\Role;
use App\Service;
use App\Status;
use App\User;
use App\Visit;
use App\Where;
use App\Worktime;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function show(Request $request)
    {

        $print = Visit::where('date', 'like', '%' . \Carbon\Carbon::now()->addDay()->format('Y-m-d') . '%')->orderBy('date')->where('status_id', '!=', 5)->with('doctor')->with('patient')->with('service')->with('status_my')->get()->groupBy(function ($val) {
            return $val->doctor->surname . ' ' . $val->doctor->name . ' ' . $val->doctor->patronymic;
        });

        $print_work = Worktime::where('date', 'like', '%' . \Carbon\Carbon::now()->addDay()->format('Y-m-d') . '%')->get()->groupBy(function ($val) {
            return $val->doctor->surname . ' ' . $val->doctor->name . ' ' . $val->doctor->patronymic;
        });


        $time = [];

        foreach ($print_work as $key => $worktimes) {

            foreach ($worktimes as $worktime) {
                $start = strtotime(\Carbon\Carbon::createFromDate($worktime->start));
                $i = 0;
                if (!$worktime->is_holiday) {
                    $start = strtotime(\Carbon\Carbon::parse($worktime->start));

                    for (; $start < strtotime(\Carbon\Carbon::parse($worktime->end)); $start += 1800) {
                        $time[$worktime->doctor->surname . ' ' . $worktime->doctor->name . ' ' . $worktime->doctor->patronymic][$start] = $start;
                    }
                }
            }

            if ($time) {
                foreach ($time as $doc_key => $key_time) {
                    foreach ($key_time as $free_time) {
                        foreach ($print as $key_doctor => $var) {
                            foreach ($var as $value) {
                                if (($free_time == strtotime(\Carbon\Carbon::parse($value->date))) && ($doc_key == $key_doctor)) {

                                    $time[$doc_key][$free_time] = [];
                                    $time[$doc_key][$free_time]['patient'] = $value->patient->first_name . ' ' . $value->patient->name . ' ' . $value->patient->last_name;
                                    $time[$doc_key][$free_time]['birthday'] = $value->patient->birthday;
                                    $time[$doc_key][$free_time]['service'] = $value->service->name;
                                    $time[$doc_key][$free_time]['phone'] = $value->patient->phone;
                                }
                            }
                        }
                    }
                }
            }
        }
        return view('adminCalendar::show')->with([
            'patients' => Patient::orderBy('first_name')->limit(1)->get(),
            'statuses' => Status::all()->keyBy('id'),
            'services' => Service::all(),
            'clinics' => Clinic::orderByDesc('id')->get()->keyBy('id'),
            'wheres' => Where::all(),
            'doctors' => User::role('Doctor')->get()->keyBy('id'),
        ]);
    }


    public function getWorkTimes(Request $request)
    {
        if ($request->isMethod('post') && $request->filled('start') && $request->filled('end')) {

            return response()->json([
                'work_times' => Worktime::whereBetween('date', [$request->start, $request->end])->get(),
                'start' => $request->start,
                'end' => $request->end
            ]);
        }
    }


}
