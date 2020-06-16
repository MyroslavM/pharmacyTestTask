<?php

namespace App\Modules\AdminUser\Http\Controllers;

use App\Traits\SaveTrait;
use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use SaveTrait;

    private $files = ['avatar' => ['path' => 'image/users', 'disk' => 'publicImage']];
    private $form = [];

    public function show(Request $request){
        if($request->isMethod('POST')){
            $this->form = [
                'name'=>['required','max'=>'255'],
                'surname'=> ['required','max'=>'255'],
                'patronymic'=> ['required','max'=>'255'],
                'email'=> ['required','max'=>'255','email',Rule::unique('users')->ignore(auth()->user()->id,'id')],
                'address'=> ['nullable','max'=> '255'],
                'phone'=>['nullable', 'phone' => 'UA',Rule::unique('users')->ignore(auth()->user()->id,'id')],
                'experience' => ['nullable','max'=>'255'],
                'degree' => ['nullable','max'=>'255'],
                'description' => ['nullable'],
                'specialization' => ['nullable','max'=>'255'],
            ];

            try {
                \request()->merge(['phone' => \phone($request->phone, 'UA', 0)]);
            } catch (\Exception $exception) {

            }

            return $this->save(auth()->user());
        }
        return view('adminUser::show');
    }

    public function changeAvatar(Request $request){
        if ($request->isMethod('POST')){
            $this->form = [
                'avatar' => ['required','image']
            ];

            return $this->save(Auth()->user());
        }
    }

    public function changePassword(Request $request){
        if ($request->isMethod('POST')){
            if(Hash::check($request->last_password, auth()->user()->password)) {
                $this->form = [
                    'password' => ['required', 'min' => '6']
                ];
                return $this->save(Auth()->user());
            }else{
                return response(['status'=>0,'message'=>'Старий пароль вказано невірно']);
            }
        }
    }

    public function updateResponse($instance, $callbackResult)
    {
        return response(['status'=>1,'message'=>'Зміни збережено','avatar'=>$instance->avatar]);
    }
}
