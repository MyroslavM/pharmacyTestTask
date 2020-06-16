<?php

namespace App\Modules\Adminthamplatesfield\Http\Controllers;

use App\Clinic;
use App\Traits\SaveTrait;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;



class FieldsController extends Controller
{
    use SaveTrait;
    private $form=[
        'name'=>['required','max'=>'30'],
        'address'=> ['required','max'=>'60'],
        'color'=> ['required','max'=>'60'],
        'start_time'=> ['required','max'=>'60'],
        'end_time'=> ['required','max'=>'60'],
    ];

    public function show (){
        $clinics = Clinic::all();

        return view('adminClinic::show')->with(['clinics'=>$clinics]);
    }

    public function add(Request $request){
        if ($request->isMethod('POST')){

            return $this->save(Clinic::class);
        }
        return view('adminClinic::add');
    }

    public function edit(Request $request,$id){

        $clinic = Clinic::where('id',$id)->firstOrFail();

        if ($request->isMethod('POST')){

            return $this->save($clinic);
        }
        return view('adminClinic::edit')->with(['clinic'=>$clinic]);
    }

    public function createResponse($instance, $callbackResult)
    {
        return response(['status'=>1,'message'=>'Запис успішно додано','redirect'=>route('adminClinics')]);
    }

    public function delete(Request $request){

        Clinic::findOrFail($request->input('id'))->delete();

        return response(['status' => 1, 'message' => 'Запис видалено','redirect'=>route('adminClinics')]);
    }
}
