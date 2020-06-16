<?php

namespace App\Modules\Widget\Http\Controllers;

use App\Patient;
use App\Role;
use App\Service;
use App\Traits\SaveTrait;
use App\User;
use App\Visit;
use App\Where;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class WidgetController extends Controller
{
    use SaveTrait;

    private $form = [
        'name'       => ['required', 'max' => '30'],
        'first_name' => ['required', 'max' => '30'],
        'last_name'  => ['required', 'max' => '30'],
        'address'    => ['required', 'max' => '60'],
        'phone'      => ['required', 'phone' => 'UA'],
        'birthday'   => ['required', 'date'],
        'date'       => ['required'],
        'complaints' => ['nullable'],
        'where_id'   => ['required'],
        'service_id' => ['required'],
        'status_id'  => ['required'],
        'doctor_id'  => ['required', 'numeric'],
        'clinic_id'  => ['required', 'numeric']

    ];

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (isset($request->is_new)) {
                try {
                    \request()->merge(['phone' => \phone($request->phone, 'UA', 0)]);
                } catch (\Exception $exception) {

                }

                if (isset($request->date) && isset($request->start)) {
                    $date = $request->date;
                    $request->merge(['date' => date_format(date_create_from_format('d.m.Y', $date), 'Y-m-d') . ' ' . $request->start]);
                    $request->merge(['status_id' => 1]);
                }

                if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
                    return $validator;
                }


                $new_patient = Patient::firstOrCreate(['name'=>$request->name,'first_name'=>$request->first_name,'last_name'=>$request->last_name,'phone'=>$request->phone,'birthday'=>date_format(date_create_from_format('d.m.Y', $request->birthday), 'Y-m-d')]);
                if (Patient::where('phone', $request->phone)->first()) {
                    $new_patient->is_children = 1;
                } else {
                    $new_patient->is_children = 0;
                }

                $new_patient->name = $request->name;
                $new_patient->last_name = $request->last_name;
                $new_patient->first_name = $request->first_name;
                $new_patient->where_id = $request->where_id;
                $new_patient->phone = $request->phone;
                $new_patient->birthday = date_format(date_create_from_format('d.m.Y', $request->birthday), 'Y-m-d');
                $new_patient->address = $request->address;

                if (!Visit::where('doctor_id',$request->doctor_id)->where('date', $request->date)->whereNotIn('status_id',[5])->first()) {
                    $new_patient->save();

                    $this->form = [
                        'patient_id' => ['required', 'numeric'],
                        'date'       => ['required'],
                        'service_id' => ['required'],
                        'status_id'  => ['required'],
                        'complaints' => ['nullable'],
                        'doctor_id'  => ['required', 'numeric'],
                        'clinic_id'  => ['required', 'numeric']
                    ];

                    if ($request->service_id == 'also') {
                        unset($this->form['service_id']);
                    }
                    $request->merge(['patient_id' => $new_patient->id]);


                    $txt = '';
                    $txt .= $new_patient->is_children ? 'Номер члена сім\'ї%0A' : '%0A';
                    $txt .= "<b>" . 'Паціент' . "</b> : " . $new_patient->first_name . ' ' . $new_patient->name . ' ' . $new_patient->last_name . "%0A";
                    $txt .= "<b>" . 'Телефон' . "</b> : " . $new_patient->phone . "%0A";
                    $txt .= "<b>" . 'Дата народження' . "</b> : " . \Carbon\Carbon::parse($new_patient->birthday)->format('d.m.Y') . "%0A";
                    $txt .= "<b>" . 'Дата і час запису' . "</b> : " . \Carbon\Carbon::parse($request->date)->format('d.m.Y H:i') . "%0A";
                    $txt .= "<b>" . 'Коментар' . "</b> : " . $request->complaints . "%0A";
//                    $send = fopen(
//                        'https://api.telegram.org/bot' . config('services.telegram.token') .
//                        '/sendMessage?chat_id=' . config('services.telegram.chat') . '&parse_mode=html&text=' .
//                        "<b>Новий запис з віджета</b> %0A %0A" . $txt, 'r ');
                    return $this->save(Visit::class);

                } else {
                    return response(['status' => 0, 'message' => 'Цей час вже зайнятий оберіть будь ласка інший']);
                }
            } else {

                $this->form = [
                    'patient_id' => ['required', 'numeric'],
                    'date'       => ['required'],
                    'service_id' => ['required'],
                    'status_id'  => ['required'],
                    'also'       => ['nullable'],
                    'complaints' => ['nullable'],
                    'doctor_id'  => ['required', 'numeric'],
                    'clinic_id'  => ['required', 'numeric']
                ];

                try {
                    \request()->merge(['phone2' => \phone($request->phone2, 'UA', 0)]);
                } catch (\Exception $exception) {

                }
                if (isset($request->phone2)) {
                    $patient = Patient::where('phone', $request->phone2)->where('is_children', 0)->first();
                    if (isset($patient->id)) {
                        $request->merge(['patient_id' => $patient->id]);
                    } else {
                        return response(['status' => 0, 'message' => 'Такий номер телефону не знайдено']);
                    }
                } else {
                    return response(['status' => 0, 'message' => 'Перевірте правильність телефону']);
                }

                if ($request->service_id == 'also') {
                    unset($this->form['service_id']);
                }

                if (isset($request->date) && isset($request->start)) {
                    $request->merge(['date' => date_format(date_create_from_format('d.m.Y', $request->date), 'Y-m-d') . ' ' . $request->start]);
                    $request->merge(['status_id' => 1]);
                }

                if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
                    return $validator;
                }

                if (!Visit::where('doctor_id',$request->doctor_id)->where('date', $request->date)->whereNotIn('status_id',[5])->first()) {

                    $txt = '';
                    $txt .= $patient->is_children ? 'Номер члена сімї' : 'Власний номер' . "%0A";
                    $txt .= "<b>" . 'Паціент' . "</b> : " . $patient->first_name . ' ' . $patient->name . ' ' . $patient->last_name . "%0A";
                    $txt .= "<b>" . 'Телефон' . "</b> : " . $patient->phone . "%0A";
                    $txt .= "<b>" . 'Дата народження' . "</b> : " . \Carbon\Carbon::parse($patient->birthday)->format('d.m.Y') . "%0A";
                    $txt .= "<b>" . 'Дата і час запису' . "</b> : " . \Carbon\Carbon::parse($request->date)->format('d.m.Y H:i') . "%0A";
                    $txt .= "<b>" . 'Коментар' . "</b> : " . $request->complaints . "%0A";
//                    $send = fopen(
//                        'https://api.telegram.org/bot' . config('services.telegram.token') .
//                        '/sendMessage?chat_id=' . config('services.telegram.chat') . '&parse_mode=html&text=' .
//                        "Новий запис з віджета %0A %0A" . $txt, 'r ');

                    return $this->save(Visit::class);
                } else {
                    return response(['status' => 0, 'message' => 'Цей час вже зайнятий оберіть будь ласка інший']);
                }
            }
        }


        return view('widget::add')->with(['users' => User::whereIn('id', Role::where('role_id', 3)->pluck('model_id'))->get(), 'services' => Service::all(), 'wheres' => Where::all()]);
    }
}
