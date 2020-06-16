<?php

namespace App\Modules\AdminVisit\Http\Controllers;

use App\Patient;
use App\Traits\SaveTrait;
use App\Visit;
use App\VisitService;
use App\Worktime;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use PhpParser\Builder\Class_;

class VisitDoctorController extends Controller
{
    use SaveTrait;

    private $form = [
        'patient_id' => ['required', 'numeric'],
        'date'       => ['required'],
        'date_end'   => ['required'],
        'service_id' => ['required'],
        'status_id'  => ['required'],
        'complaints' => ['nullable'],
        'doctor_id'  => ['required', 'numeric'],
        'clinic_id'  => ['required', 'numeric']
    ];

    public function add(Request $request)
    {
        $date_start = \Carbon\Carbon::parse($request->start)->format('Y-m-d H:i');
        $date_end = \Carbon\Carbon::parse($request->end)->format('Y-m-d H:i');

        $request->merge(['date' => $date_start]);
        $request->merge(['date_end' => $date_end]);

        if (isset($request->is_new) && $request->is_new != '0') {
            $this->form = [
                'name'       => ['required', 'max' => '30'],
                'first_name' => ['required', 'max' => '30'],
                'last_name'  => ['required', 'max' => '30'],
                'phone'      => ['required', 'phone' => 'UA'],
                'birthday'   => ['required', 'date', 'date_format' => 'd.m.Y'],
                'date'       => ['required', 'date', 'date_format' => 'Y-m-d H:i'],
                'date_end'   => ['required', 'date', 'date_format' => 'Y-m-d H:i'],
                'complaints' => ['nullable'],
                'where_id'   => ['required'],
                'service_id' => ['required'],
                'status_id'  => ['required'],
                'doctor_id'  => ['required', 'numeric'],
            ];
            try {
                \request()->merge(['phone' => \phone($request->phone, 'UA', '')]);
            } catch (\Exception $exception) {

            }
            \Debugbar::info($request->phone);

            if (isset($request->date) && isset($request->date_end)) {
                $request->merge(['status_id' => 1]);
            }

            if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
                return response($validator->content());
            }

            $new_patient = Patient::firstOrCreate(['name'=>$request->name,'first_name'=>$request->first_name,'last_name'=>$request->last_name,'phone'=>$request->phone,'birthday'=>date_format(date_create_from_format('d.m.Y', $request->birthday), 'Y-m-d')]);

            if(Patient::where('phone',$request->phone)->first()){
                $new_patient->is_children = 1;
            }else{
                $new_patient->is_children = 0;
            }

            $new_patient->name = $request->name;
            $new_patient->last_name = $request->last_name;
            $new_patient->first_name = $request->first_name;
            $new_patient->where_id = $request->where_id;
            $new_patient->phone = $request->phone;
            $new_patient->birthday = date_format(date_create_from_format('d.m.Y', $request->birthday), 'Y-m-d');
            $new_patient->address = $request->address;

            $worktime = Worktime::where('doctor_id', $request->doctor_id)->where('start', '<=', $request->date)->where('end', '>', $request->date)->first();

            if ($worktime) {
                $request->merge(['status_id' => 1]);
                $request->merge(['clinic_id' => $worktime->clinic_id]);
            } else {
                return response(['status' => 0, 'message' => 'В цей час лікар не працює']);
            }

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
                    'date'       => ['required'],
                    'date_end'   => ['required'],
                    'status_id'  => ['required'],
                    'complaints' => ['nullable'],
                    'service_id' => ['required'],
                    'doctor_id'  => ['required', 'numeric'],
                    'clinic_id'  => ['required', 'numeric']
                ];

	            unset($this->form['service_id']);

                $request->merge(['patient_id' => $new_patient->id]);

                return $this->save(Visit::class);

            } else {
                return response(['status' => 0, 'message' => 'Цей час вже зайнятий оберіть будь ласка інший']);
            }
        } else {

            $worktime = Worktime::where('doctor_id', $request->doctor_id)->where('start', '<=', $request->date)->where('end', '>', $request->date)->first();

            if ($worktime) {
                $request->merge(['status_id' => 1]);
                $request->merge(['clinic_id' => $worktime->clinic_id]);
            } else {
                return response(['status' => 0, 'message' => 'В цей час лікар не працює']);
            }

            if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
                return response($validator->content());
            }

            if (!Visit::where('doctor_id', $request->doctor_id)
                ->where(function($query) use ($request) {
                    $query->whereBetween('date', [$request->date, $request->date_end])
                        ->whereBetween('date_end', [$request->date, $request->date_end]);
                })
                ->whereNotIn('status_id', [5])
                ->first())
            {
	            unset($this->form['service_id']);

                return $this->save(Visit::class);
            } else {
                return response(['status' => 0, 'message' => 'Цей час вже зайнятий оберіть будь ласка інший']);
            }
        }
    }

    public function editStatus(Request $request)
    {

        $this->form = [
            'status_id' => ['required', 'numeric', 'min:1', 'max:5']
        ];

        if (isset($request->status_id) && isset($request->visit_id)) {
            $visit = Visit::where('id', $request->visit_id)->first();

            if ($visit) {
                return $this->save($visit);
            } else {
                return response(['status' => 0, 'message' => 'Something wrong! Visit not found']);
            }
        }
    }

    public function closeStatus(Request $request)
    {
        $this->form = [
            'status_id' => ['required']
        ];
        if (isset($request->visit_id)) {
            \request()->merge(['status_id' => 5]);
            $visit = Visit::where('id', $request->visit_id)->first();

            if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
                return response($validator->content());
            }
            if ($visit) {
                return $this->save($visit);
            } else {
                return response(['status' => 0, 'message' => '1234']);
            }
        }
    }

    public function deleteVisit(Request $request)
    {
        if ($request->isMethod('post') && $request->filled('visit_id')) {
            $visit = Visit::find($request->visit_id);

            if ($visit) {
                $visit->delete();

                return response(['status' => 1, 'title' => '', 'message' => 'Візит успішно видалений']);
            }
        }

        return response(['status' => 0, 'title' => '', 'message' => 'Помилка при видаленні']);
    }

    public function getVisits(Request $request)
    {
        if ($request->isMethod('post') && $request->filled('start') && $request->filled('end')) {

        	$visits = Visit::with('visit_services')->whereBetween('date', [$request->start, $request->end . ' 23:59:59'])->where('status_id','!=',5)->with('patient')->get();
        	foreach ($visits as $visit) {
        		$visit->visit_services->load('service');
	        }
            return response()->json([
                'visits' => $visits
            ]);
        }
    }

	public function createResponse($instance, $callbackResult)
	{
		if (isset(\request()->service_id) && \request()->service_id != null) {
			$new_service = new VisitService();
			$new_service->visit_id = $instance->id;
			$new_service->service_id = \request()->service_id;
			$new_service->save();
		}

		return response(['status' => 1, 'message' => 'Запис успішно створений']);
	}

    public function updateResponse($instance, $callbackResult)
    {
        return response(['status' => 1, 'message' => 'Зміни успішно збережено', 'statusId' => $instance->status_id]);
    }
}
