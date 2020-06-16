<?php

namespace App\Modules\Adminthamplatesfield\Http\Controllers;

use App\Disease;
use App\Http\Controllers\Controller;
use App\Traits\SaveTrait;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    use SaveTrait;
    private $form = [
        'name' => ['required', 'max' => '30'],
    ];

    public function show()
    {
        $diseases = Disease::orderByDesc('id')->paginate('10');

        return view('adminthamplatesfield::diseaseShow')->with(['diseases' => $diseases]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {

            return $this->save(Disease::class);
        }
//        return view('adminthamplatesfield::add');
    }

    public function edit(Request $request, $id)
    {
        $disease = Disease::where('id', $id)->firstOrFail();

        if ($request->isMethod('POST')) {

            return $this->save($disease);
        }

        return view('adminthamplatesfield::diseaseEdit')->with(['disease' => $disease]);
    }

    public function createResponse($instance, $callbackResult)
    {
        return response(['status' => 1, 'message' => 'Запис успішно додано', 'redirect' => route('adminDiseases')]);
    }

    public function delete(Request $request)
    {

        Disease::findOrFail($request->input('id'))->delete();

        return response(['status' => 1, 'message' => 'Запис видалено', 'redirect' => route('adminDiseases')]);
    }
}
