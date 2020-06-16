<?php

namespace App\Modules\AdminPatient\Http\Controllers;

use App\Blacklist;
use App\Diagnosis;
use App\Disease;
use App\Manipulation;
use App\Patient;
use App\PatientForm043;
use App\Product;
use App\Role;
use App\Service;
use App\Status;
use App\Traits\SaveTrait;
use App\User;
use App\Visit;
use App\VisitCost;
use App\VisitManipulation;
use App\VisitProduct;
use App\VisitService;
use App\VisitUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    use SaveTrait;
    private $form = [
        'name'            => ['required', 'max' => '30'],
        'first_name'      => ['required', 'max' => '30'],
        'last_name'       => ['nullable', 'max' => '200'],
        'address'         => ['nullable', 'max' => '60'],
        'anamnez'         => ['nullable', 'max' => '200'],
        'phone'           => ['required', 'phone' => 'UA'],
        'birthday'        => ['nullable', 'date', 'date_format' => 'd.m.Y'],
        'confirmed'       => ['nullable', 'in' => '1,0'],
        'confirmed_phone' => ['nullable', 'in' => '1,0'],

        'email'         => ['nullable', 'max' => '200'],
        'comment'         => ['nullable', 'max' => '200'],
        'gender' => ['nullable', 'in' => '1,0'],

    ];

    public function show()
    {
//        $items = Patient::all();

        return view('adminPatient::show');
    }

    public function add(Request $request)
    {
	    $doctors = User::whereIn('id', Role::where('role_id', Role::ROLE_DOCTOR)->pluck('model_id'))->get();

        if ($request->isMethod('POST')) {

	        $this->form = [
		        'name'            => ['required', 'max' => '30'],
		        'first_name'      => ['required', 'max' => '30'],
		        'last_name'       => ['nullable', 'max' => '200'],
		        'address'         => ['nullable', 'max' => '60'],
		        'anamnez'         => ['nullable', 'max' => '200'],
		        'phone'           => ['required', 'phone' => 'UA'],
		        'birthday'        => ['nullable', 'date'],
		        'confirmed'       => ['nullable', 'in' => '1,0'],
		        'confirmed_phone' => ['nullable', 'in' => '1,0'],

		        'email'           => ['nullable', 'max' => '200'],
		        'comment'         => ['nullable', 'max' => '200'],
		        'gender'          => ['nullable', 'in' => '1,0'],
	        ];

            if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
                return $validator;
            }

            if (Patient::where('phone', $request->phone)->first()) {
                $request->merge(['is_children' => 1]);
            } else {
                $request->merge(['is_children' => 0]);
            }

            try {
                \request()->merge(['phone' => \phone($request->phone, 'UA', 0)]);
            } catch (\Exception $exception) {

            }

	        if ($request->birthday) {
		        $request->merge(['birthday' => Carbon::parse($request->birthday)->format('Y-m-d')]);
	        }

	        $patient = new Patient();
	        $patient->fill($request->all());

            return $this->save($patient);
        }

        return view('adminPatient::add', compact('doctors'));
    }

    public function edit(Request $request, $id)
    {
        $item = Patient::where('id', $id)->firstOrFail();

	    $doctors = User::whereIn('id', Role::where('role_id', Role::ROLE_DOCTOR)->pluck('model_id'))->get();

	    $visits = Visit::where('patient_id', $id)->get();

        $is_black_list = Blacklist::where('patient_id', $item->id)->count();

        if ($request->isMethod('POST')) {

            $this->form = [
                'name'            => ['required', 'max' => '30'],
                'first_name'      => ['required', 'max' => '30'],
                'last_name'       => ['nullable', 'max' => '200'],
                'address'         => ['nullable', 'max' => '60'],
                'anamnez'         => ['nullable', 'max' => '200'],
                'phone'           => ['required', 'phone' => 'UA'],
                'birthday'        => ['nullable', 'date'],
                'confirmed'       => ['nullable', 'in' => '1,0'],
                'confirmed_phone' => ['nullable', 'in' => '1,0'],

                'email'           => ['nullable', 'max' => '200'],
                'comment'         => ['nullable', 'max' => '200'],
                'gender'          => ['nullable', 'in' => '1,0'],
            ];

	        if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
		        return $validator;
	        }

            try {
                \request()->merge(['phone' => \phone($request->phone, 'UA', 0)]);
            } catch (\Exception $exception) {

            }

            if (Patient::where('phone', $request->phone)->first()) {
                $request->merge(['is_children' => 1]);
            } else {
                $request->merge(['is_children' => 0]);
            }

            if ($is_black_list != $request->blacklist) {
                if ($request->blacklist) {
                    $black_list = new Blacklist();
                    $black_list->patient_id = $item->id;
                    $black_list->comment = $request->comment;
                    $black_list->save();
                } else {
                    Blacklist::where('patient_id', $item->id)->delete();
                }
            }

            $request->merge(['birthday' => Carbon::parse($request->birthday)->format('Y-m-d')]);

	        $item->fill($request->all());

            return $this->save($item);
        }

        return view('adminPatient::edit',compact('item', 'is_black_list', 'doctors', 'visits'));
    }

	public function editVisit(Request $request, $id, $visitId)
	{
		$visit = Visit::where('id', $visitId)
			->with('status_my')->with('diagnosis')->with('visit_products')->with('visit_services')->with('visit_manipulations')
			->firstOrFail();

		$visit_data['diseases'] = $visit->diagnosis->pluck('disease_id');
		$visit_data['products'] = $visit->visit_products->pluck('product_id');
		$visit_data['services'] = $visit->visit_services->pluck('service_id');
		$visit_data['manipulations'] = $visit->visit_manipulations->pluck('manipulation_id');

		$images = [
			'3d' => VisitUpload::where(['visit_id' => $visit->id, 'type_image' => VisitUpload::TYPE_3D])->first(),
			'additional' => VisitUpload::where(['visit_id' => $visit->id, 'type_image' => VisitUpload::TYPE_ADDITIONAL])->get(),
		];

		if ($visit->status_my->id != 3 && $visit->status_my->id != 4) {
			if ($request->isMethod('POST')) {

				if ($request->has('image')) {
					$response = $this->uploadFile($request, $visit);

					return response(['status' => 1, 'images' => $response]);
				}

				if ($request->get('action') === 'image_delete') {
					$img = VisitUpload::find($request->image_id);

					$path = $img->filepath .$img->filename;

					if (file_exists(public_path($path))){
						unlink(public_path($path));
						$img->delete();

						return response(['status' => 1, 'images' => $path]);
					}

					return response(['status' => 0, 'images' => $path]);
				}

				$this->form = [
					'conclusion' => ['nullable'],
					'status_id' => ['required', 'numeric'],
					'date_manipulation' => ['required_with:manipulation_id'],
					'complaints' => ['nullable'],
					'diagnosis' => ['nullable', 'array'],
					'diagnosis.*' => ['nullable', 'numeric', 'distinct'],
					'products' => ['nullable', 'array'],
					'products.*' => ['nullable', 'numeric', 'distinct'],
					'manipulations' => ['nullable', 'array'],
					'manipulations.*' => ['nullable', 'numeric', 'distinct'],
					'services' => ['nullable', 'array'],
					'services.*' => ['nullable', 'numeric', 'distinct'],
				];

				if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
					return $validator;
				}

				if ($request->date_manipulation) {
					$request->merge(['date_manipulation' => date_format(date_create_from_format('d.m.Y', $request->date_manipulation), 'Y-m-d')]);
				}

				$this->form = [
					'conclusion' => ['nullable'],
					'status_id' => ['required', 'numeric'],
					'date_manipulation' => ['required_with:manipulation_id'],
					'complaints' => ['nullable'],
				];

				return $this->save($visit);
			}

			$template = 'adminPatient::edit_visit';
		} else {
			$template = 'adminPatient::closed_visit';
		}
		return view($template)->with([
			'visit' => $visit,
			'item' => $visit->patient,
			'costs' => VisitCost::where('visit_id', $visitId)->get(),
			'images' => $images,
			'visit_data' => $visit_data,
			'diseases' => Disease::all(),
			'services' => Service::all(),
			'products' => Product::all(),
			'statuses' => Status::all(),
			'manipulations' => Manipulation::all()
		]);
	}

	public function visit(Request $request, $id)
	{
		$item = Patient::where('id', $id)->firstOrFail();

		return view('adminPatient::visit', compact('item'));
	}

	public function form043(Request $request, $id)
	{
		$item = Patient::where('id', $id)->firstOrFail();
		$form043 = PatientForm043::where('patient_id', $item->id)->first();

		if ($request->isMethod('POST')) {

			$this->form = [
				'diagnose'        => ['nullable', 'max' => '30'],
				'complaint'       => ['nullable', 'max' => '30'],
				'transferred_diseases' => ['nullable', 'max' => '30'],
				'current_disease'      => ['nullable', 'max' => '30'],
				'research_data'        => ['nullable', 'max' => '30'],
			];

			if (!(($validator = $this->validateRequest()) instanceof \Illuminate\Validation\Validator)) {
				return $validator;
			}

			if ($request->has('data')) {
				$result['data'] = $request->data;
			}

			if ($request->has('date_journal')) {
				$result['date_journal'] = $request->date_journal;
			}

			if ($request->has('text_journal')) {
				$result['text_journal'] = $request->text_journal;
			}

			if ($request->has('examination')) {
				$result['examination'] = $request->examination;
			}

			if ($request->has('treatment')) {
				$result['treatment'] = $request->treatment;
			}

			$json = json_encode($result);

			if ($form043) {
				$form043->fill($request->all());
				$form043->data = $json;
			} else {
				$form043 = new PatientForm043();
				$form043->fill($request->all());
				$form043->patient_id = $item->id;
				$form043->data = $json;
			}

			$form043->save();

			return response(['status' => 1, 'message' => 'Зміни збережені']);
		}

		$data = isset($form043->data) ? json_decode($form043->data, true) : [];

		return view('adminPatient::form043', compact('item', 'form043', 'data'));
	}

	public function epicriz(Request $request, $id)
	{
		$item = Patient::where('id', $id)->firstOrFail();
		$form043 = PatientForm043::where('patient_id', $item->id)->first();

		if ($request->isMethod('POST')) {

			if ($request->has('date_epicriz')) {
				$result['date_epicriz'] = $request->date_epicriz;
			}

			if ($request->has('date_epicriz')) {
				$result['text_epicriz'] = $request->text_epicriz;
			}

			$json = json_encode($result);

			if ($form043) {
				$form043->epicriz = $json;
			} else {
				$form043 = new PatientForm043();
				$form043->patient_id = $item->id;
				$form043->epicriz = $json;
			}

			$form043->save();

			return response(['status' => 1, 'message' => 'Зміни збережені']);
		}

		$data = isset($form043->epicriz) ? json_decode($form043->epicriz, true) : [];

		return view('adminPatient::epicriz', compact('item', 'data'));
	}

    public function createResponse($instance, $callbackResult)
    {
        return response(['status' => 1, 'message' => 'Запис успішно додано', 'redirect' => route('editPatient', ['id' => $instance->id])]);
    }

	public function updateResponse($instance, $callbackResult)
	{
		DB::transaction(function () use ($instance) {
			Diagnosis::where('visit_id', $instance->id)->delete();

			if (isset(\request()->diagnosis) && \request()->diagnosis[0] != null) {
				foreach (\request()->diagnosis as $diagnos) {
					$new_diagnos = new Diagnosis();

					$new_diagnos->visit_id = $instance->id;
					$new_diagnos->disease_id = $diagnos;
					$new_diagnos->patient_id = $instance->patient_id;
					$new_diagnos->save();
				}
			}
		});

		if (Route::currentRouteName() === 'editVisitPatient') {
			return response([
				'status' => 1,
				'message' => 'Зміни успішно збережено',
				'redirect' => route('visitPatient', ['id' => $instance->patient->id])
			]);
		}

		return response([
			'status' => 1,
			'message' => 'Зміни успішно збережено'
		]);
	}

    public function delete(Request $request)
    {
        Patient::findOrFail($request->input('id'))->delete();

        return response(['status' => 1, 'message' => 'Запис видалено', 'redirect' => route('adminPatients')]);
    }

    public function getPatientTable()
    {
        return DataTables::of(Patient::get())->only(['id', 'name', 'last_name', 'phone', 'first_name', 'birthday', 'is_children'])
            ->editColumn('name', function (Patient $item) {
                return $item->first_name . ' ' . $item->name . ' ' . $item->last_name;
            })->editColumn('phone', function (Patient $item) {
                return $item->phone ?? 'Не вказано!';
            })->editColumn('birthday', function (Patient $item) {
                return \Carbon\Carbon::parse($item->birthday)->format('d.m.Y');
            })->editColumn('is_children', function (Patient $item) {
                return '<a href="' . route('editPatient', $item->id) . '" title="Редагувати пацієнта" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex mx-auto"><i class="la la-edit"></i></a>';
            })->rawColumns(['is_children'])->toJson();
    }

	public function getPatientVisitTable($id)
	{
		return DataTables::of(Visit::where('patient_id', $id)->with('doctor')->with('status_my')->get())
			->editColumn('doctor', function (Visit $item) {
				return $item->doctor->fullName();
			})->editColumn('status', function (Visit $item) {
				return $item->status_my->name;
			})->editColumn('cost', function (Visit $item) {
				return $item->cost . 'грн';
			})->editColumn('date', function (Visit $item) {
				return \Carbon\Carbon::parse($item->date)->format('d.m.Y H:i') . '-' . \Carbon\Carbon::parse($item->date_end)->format('H:i');
			})->editColumn('edit', function (Visit $item) {
				return '<a href="' . route('editVisitPatient', ['id' => $item->patient->id, 'visit_id' => $item->id]) . '" title="Редагувати візит" class="btn btn-sm btn-outline-brand btn-elevate btn-icon d-flex mx-auto"><i class="la la-edit"></i></a>';
			})->rawColumns(['edit'])->toJson();
	}

    /*
     * Search patients by First Name and Name and Last Name columns
     * @return Collection
     * */
    public function search(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'search_query' => 'min:2|max:255',
            ]);

            if ($validator->fails()) {
                $patients = Patient::orderBy('first_name')->limit(20)->get();
            } else {
                $patients = Patient::search($request->search_query)->orderBy('first_name')->limit(20)->get();
            }

            $formatted_data = [];

            foreach ($patients as $item) {
                $formatted_data[] = [
                    'id'    => $item->id,
                    'text'  => "{$item->first_name} {$item->name} {$item->last_name} {$item->birthday}",
                    'phone' => $item->phone
                ];
            }

            return response()->json($formatted_data);
        }

    }

	public function updateCostVisit(Request $request)
	{
		$id = $request->id;
		$type = $request->type;
		$visit = $request->visit_id;
		$action = $request->action;

		if ($type === 'AppVisit') {
			$modelType = Service::class;

			if ($action === 'delete') {
				VisitService::where(['visit_id' => $visit, 'service_id' => $id])->delete();
				VisitCost::where(['visit_id' => $visit, 'model_type' => $modelType, 'model_id' => $id])->delete();
			}

			if ($action === 'add') {
				$service = Service::where('id', $id)->firstOrFail();
				$this->createVisitCost($visit, $service, $modelType);

				$new_service = new VisitService();
				$new_service->visit_id = $visit;
				$new_service->service_id = $service->id;
				$new_service->save();
			}

		} elseif ($type === 'AppProduct') {
			$modelType = Product::class;

			if ($action === 'delete') {
				VisitProduct::where(['visit_id' => $visit, 'product_id' => $id])->delete();
				VisitCost::where(['visit_id' => $visit, 'model_type' => $modelType, 'model_id' => $id])->delete();
			}

			if ($action === 'add') {
				$product = Product::where('id', $id)->firstOrFail();
				$this->createVisitCost($visit, $product, $modelType);

				$new_service = new VisitProduct();
				$new_service->visit_id = $visit;
				$new_service->product_id = $product->id;
				$new_service->save();
			}

		} elseif ($type === 'AppManipulation') {
			$modelType = Manipulation::class;

			if ($action === 'delete') {
				VisitManipulation::where(['visit_id' => $visit, 'manipulation_id' => $id])->delete();
				VisitCost::where(['visit_id' => $visit, 'model_type' => $modelType, 'model_id' => $id])->delete();
			}

			if ($action === 'add') {
				$manipulation = Manipulation::where('id', $id)->firstOrFail();
				$this->createVisitCost($visit, $manipulation, $modelType);

				$new_service = new VisitManipulation();
				$new_service->visit_id = $visit;
				$new_service->manipulation_id = $manipulation->id;
				$new_service->save();
			}
		}

		$costs = VisitCost::where('visit_id', $visit)->get();
		$visitCost = VisitCost::where('visit_id', $visit)->sum('price');

		Visit::where('id', $visit)->update(['cost' => $visitCost]);

		return response(['status' => 1, 'costs' => $costs]);
	}

	private function createVisitCost($visit, $price, $modelType)
	{
		$service = new VisitCost();
		$service->visit_id = $visit;
		$service->model_id = $price->id;
		$service->price = $price->price;
		$service->name = $price->name;
		$service->model_type = $modelType;
		$service->save();
	}

	private function uploadFile($request, $visit) {

		$path = sprintf(VisitUpload::UPLOAD_PATH, $visit->patient->id);

		$images = $request->file('image');
		$type = VisitUpload::TYPE_ADDITIONAL;

		if (!is_array($images)) {
			$images = [$images];
			$type = VisitUpload::TYPE_3D;
		}

		$i = 0;
		foreach ($images as $image) {
			$origName = $image->getClientOriginalName();
			$name = sha1(time().random_bytes(5)) . '.' . trim($image->getClientOriginalExtension());
			$fullPatch = $path . $name;

			$image->storeAs($path, $name, 'publicImage');

			if ($type === VisitUpload::TYPE_3D) {
				VisitUpload::where(['visit_id' => $visit->id, 'type_image' => VisitUpload::TYPE_3D])->delete();
			}

			$visitUpload = new VisitUpload();
			$visitUpload->visit_id = $visit->id;
			$visitUpload->filename = $name;
			$visitUpload->filepath = $path;
			$visitUpload->type_image = $type;
			$visitUpload->original_name = $origName;
			$visitUpload->save();

			$response[$i]['id'] = $visitUpload->id;
			$response[$i]['path'] = $fullPatch;
			$response[$i]['name'] = $origName;
			$i++;
		}

		return $response;
	}
}
