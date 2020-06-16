<?php

namespace App\Modules\AdminVisit\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Patient;
use App\Role;
use App\Service;
use App\Traits\SaveTrait;
use App\User;
use App\Visit;
use App\Where;
use App\Worktime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VisitController extends Controller
{
    use SaveTrait;

    private $form = [
        'name' => ['required', 'max' => '30'],
        'first_name' => ['required', 'max' => '30'],
        'last_name' => ['required', 'max' => '30'],
        'address' => ['required', 'max' => '60'],
        'phone' => ['required', 'phone' => 'UA', 'unique' => 'patients,phone'],
        'birthday' => ['required', 'date', 'date_format' => 'd.m.Y'],
        'date' => ['required'],
        'complaints' => ['nullable'],
        'where_id' => ['required'],
        'service_id' => ['required'],
        'status_id' => ['required'],
        'doctor_id' => ['required', 'numeric'],
        'clinic_id' => ['required', 'numeric']
    ];

    public function show()
    {
        return view('adminVisit::show')->with(['visits' => Visit::orderByDesc('id')->orderBy('date')->where('status_id', '!=', 5)->with('doctor')->with('patient')->with('status_my')->get()]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (isset($request->is_new)) {
                try {
                    \request()->merge(['phone' => \phone($request->phone, 'UA', '')]);
                } catch (\Exception $exception) {
                }

                if (isset($request->date) && isset($request->start) && isset($request->end)) {
                    $request->merge(['date_end' => date_format(date_create_from_format('d.m.Y', $request->date), 'Y-m-d') . ' ' . $request->end]);
                    $request->merge(['date' => date_format(date_create_from_format('d.m.Y', $request->date), 'Y-m-d') . ' ' . $request->start]);
                    $request->merge(['status_id' => 1]);
                }

                if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
                    return $validator;
                }

                $new_patient = new Patient();

                $new_patient->name = $request->name;
                $new_patient->last_name = $request->last_name;
                $new_patient->first_name = $request->first_name;
                $new_patient->where_id = $request->where_id;
                $new_patient->phone = $request->phone;
                $new_patient->birthday = date_format(date_create_from_format('d.m.Y', $request->birthday), 'Y-m-d');
                $new_patient->address = $request->address;

                if (!Visit::where('doctor_id', $request->doctor_id)
                    ->where(function($query) use ($request) {
                        $query->whereBetween('date', [$request->date, $request->date_end])
                            ->whereBetween('date_end', [$request->date, $request->date_end]);
                    })
                    ->whereNotIn('status_id', [5])
                    ->first())
                {
                    $new_patient->save();

                    $this->form = [
                        'patient_id' => ['required', 'numeric'],
                        'date' => ['required'],
                        'date_end' => ['required'],
                        'service_id' => ['required'],
                        'status_id' => ['required'],
                        'complaints' => ['nullable'],
                        'doctor_id' => ['required', 'numeric'],
                        'clinic_id' => ['required', 'numeric']
                    ];

                    // What is it?
                    if ($request->service_id == 'also') {
                        unset($this->form['service_id']);
                    }
                    $request->merge(['patient_id' => $new_patient->id]);

                    return $this->save(Visit::class);

                } else {
                    return response(['status' => 0, 'message' => 'Цей час вже зайнятий оберіть будь ласка інший']);
                }
            } else {

                $this->form = [
                    'patient_id' => ['required', 'numeric'],
                    'date' => ['required'],
                    'date_end' => ['required'],
                    'service_id' => ['required'],
                    'status_id' => ['required'],
                    'also' => ['nullable'],
                    'complaints' => ['nullable'],
                    'doctor_id' => ['required', 'numeric'],
                    'clinic_id' => ['required', 'numeric']
                ];

                try {
                    \request()->merge(['phone2' => \phone($request->phone2, 'UA', '')]);
                } catch (\Exception $exception) {

                }

                if (isset($request->phone2)) {
                    $patient = Patient::where('phone', $request->phone2)->first();
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

                if (isset($request->date) && isset($request->start) && isset($request->end)) {
                    $request->merge(['date_end' => date_format(date_create_from_format('d.m.Y', $request->date), 'Y-m-d') . ' ' . $request->end]);
                    $request->merge(['date' => date_format(date_create_from_format('d.m.Y', $request->date), 'Y-m-d') . ' ' . $request->start]);
                    $request->merge(['status_id' => 1]);
                }

                if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
                    return $validator;
                }

                if (!Visit::where('doctor_id', $request->doctor_id)
                    ->where(function($query) use ($request) {
                        $query->whereBetween('date', [$request->date, $request->date_end])
                            ->whereBetween('date_end', [$request->date, $request->date_end]);
                    })
                    ->whereNotIn('status_id', [5])
                    ->first())
                {
                    return $this->save(Visit::class);
                } else {
                    return response(['status' => 0, 'message' => 'Цей час вже зайнятий оберіть будь ласка інший']);
                }
            }
        }

        return view('adminVisit::add')->with(['users' => User::whereIn('id', Role::where('role_id', Role::ROLE_DOCTOR)->pluck('model_id'))->get(), 'services' => Service::all(), 'wheres' => Where::all()]);
    }

    public function getVisitTable()
    {
        return DataTables::of(Visit::with('patient')->with('doctor')->with('status_my')->get())
            ->editColumn('patient', function (Visit $item) {
                return $item->patient->first_name . ' ' . $item->patient->name . ' ' . $item->patient->last_name;
            })->editColumn('doctor', function (Visit $item) {
                return $item->doctor->surname . ' ' . $item->doctor->name . ' ' . $item->doctor->patronymic;
            })->editColumn('status', function (Visit $item) {
                return $item->status_my->name;
	        })->editColumn('cost', function (Visit $item) {
		        return $item->cost . 'грн';
            })->editColumn('date', function (Visit $item) {
                return \Carbon\Carbon::parse($item->date)->format('d.m.Y H:i') . '-' . \Carbon\Carbon::parse($item->date_end)->format('H:i');
            })->editColumn('edit', function (Visit $item) {
                return '<a href="' . route('editVisitPatient', ['id' => $item->patient->id, 'visit_id' => $item->id])  . '" title="Редагувати візит" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex mx-auto"><i class="la la-edit"></i></a>';
            })->rawColumns(['edit'])->toJson();
    }

    public function createResponse($instance, $callbackResult)
    {
        return response(['status' => 1, 'message' => 'Візит успішно створено', 'redirect' => route('adminVisits')]);
    }

    public function getWorkTime(Request $request)
    {
        $dates = Worktime::where('doctor_id', $request->id)->with('clinic')->where('date', '>=', date('Y-m-d'))->whereNull('is_holiday')->get()->sortBy('start')->groupBy(function ($item) {
            return Carbon::parse($item->date)->format('d.m.Y');
        });

        $visits = Visit::where('doctor_id', $request->id)->whereNotIN('status_id', [5])->where('date', '>', date('Y-m-d'))->get()->sortBy('date')->groupBy(function ($item) {
            return Carbon::parse($item->date)->format('d.m.Y');
        });

        return response(['status' => 1, 'dates' => $dates, 'visits' => $visits]);
    }
}
