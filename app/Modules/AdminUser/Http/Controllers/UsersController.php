<?php

namespace App\Modules\AdminUser\Http\Controllers;

use App\Clinic;
use App\Http\Controllers\Controller;
use App\RoleName;
use App\Traits\SaveTrait;
use App\User;
use App\Worktime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    use SaveTrait;

    private $files = ['avatar' => ['path' => 'image/users', 'disk' => 'publicImage']];
    private $form = [];

    public function users()
    {
        return view('adminUser::users.show')->with(['users' => User::all()]);
    }

    public function add(Request $request)
    {

        if ($request->isMethod('POST')) {
            $this->form = [
                'name' => ['required', 'max' => '255'],
                'surname' => ['required', 'max' => '255'],
                'patronymic' => ['required', 'max' => '255'],
                'email' => ['required', 'max' => '255', 'email', 'unique' => 'users'],
                'address' => ['nullable', 'max' => '255'],
                'phone' => ['nullable', 'phone' => 'UA', 'unique' => 'users'],
                'experience' => ['nullable', 'max' => '255'],
                'degree' => ['nullable', 'max' => '255'],
                'description' => ['nullable', 'max' => '255'],
                'specialization' => ['nullable', 'max' => '255'],
                'password' => ['required', 'max' => '255', 'min' => '6'],
                'avatar' => ['nullable', 'image'],
                'role' => ['required', 'exists' => 'roles,name']
            ];

            if ($request->role) {
                $request->merge(['role' => $request->role]);
            }

            try {
                \request()->merge(['phone' => \phone($request->phone, 'UA', 0)]);
            } catch (\Exception $exception) {

            }

            return $this->save(User::class);
        }

        return view('adminUser::users.add')->with(['roles' => RoleName::all()]);
    }

    public function createResponse($instance, $callbackResult)
    {
        $user = User::find($instance->id);
        $user->syncRoles(\request()->role);

        return response(['status' => 1, 'message' => 'Запись успешно добавлена', 'redirect' => route('adminUsers')]);
    }

    public function edit(Request $request, $id)
    {

        $user = User::where('id', $id)->firstOrFail();

        $holidays = Worktime::where('is_holiday', 1)->where('doctor_id', $id)->pluck('date');
        $days = Worktime::Where('doctor_id', $id)->where('start', 'like', date('Y-m%'))->whereNull('is_holiday')->pluck('date');

        $days2 = Worktime::where('doctor_id', $id)->Where('start', 'like', date('Y-m%', strtotime('' . now() . '+ 1 month')))->whereNull('is_holiday')->pluck('date');
        $days = $days->merge($days2->toArray());

        $items = Worktime::where('doctor_id', $id)->Where('start', 'like', date('Y-m%'))->orWhere('start', 'like', date('Y-m%', strtotime('' . now() . '+ 1 month')))->whereNull('is_holiday')->orderBy('date')->get();

        $arr = [];
        $two_clinic = [];
        foreach ($items as $item) {
            if (isset($arr[$item->date])) {
                if ($arr[$item->date][0] != $item->clinic_id) {
                    $arr[$item->date][1] = $item->clinic_id;
                }
            } else {
                $arr[$item->date][] = $item->clinic_id;
            }
        }

        foreach ($arr as $key => $val) {
            if (count($val) == 2) {
                $two_clinic[] = $key;
            }
        }

        if ($request->isMethod('POST')) {
            $this->form = [
                'name' => ['required', 'max' => '255'],
                'surname' => ['required', 'max' => '255'],
                'patronymic' => ['required', 'max' => '255'],
                'email' => ['required', 'max' => '255', 'email', Rule::unique('users')->ignore($user->id, 'id')],
                'address' => ['nullable', 'max' => '255'],
//                'phone' => ['required', 'phone' => 'UA', Rule::unique('users')->ignore($user->id, 'id')],
                'phone' => ['nullable', 'max' => '255'],
                'experience' => ['nullable', 'max' => '255'],
                'degree' => ['nullable', 'max' => '255'],
                'description' => ['nullable'],
                'specialization' => ['nullable', 'max' => '255'],
            ];

            try {
                \request()->merge(['phone' => \phone($request->phone, 'UA', 0)]);
            } catch (\Exception $exception) {

            }

            return $this->save($user);
        }

        return view('adminUser::users.edit')->with(['user' => $user, 'days' => $days, 'holidays' => $holidays, 'clinics' => Clinic::all(), 'two_clinics' => $two_clinic]);
    }

    public function changeAvatar(Request $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        if ($request->isMethod('POST')) {
            $this->form = [
                'avatar' => ['required', 'image']
            ];

            return $this->save($user);
        }
    }

    public function changePassword(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $user = User::where('id', $id)->firstOrFail();
            if (Hash::check($request->last_password, $user->password)) {
                $this->form = [
                    'password' => ['required', 'min' => '6']
                ];

                return $this->save($user);
            } else {
                return response(['status' => 0, 'message' => 'Старий пароль вказано невірно']);
            }
        }
    }

    public function updateResponse($instance, $callbackResult)
    {
        return response(['status' => 1, 'message' => 'Зміни збережено', 'avatar' => $instance->avatar]);
    }

    public function delete(Request $request)
    {
        User::findOrFail($request->input('id'))->delete();

        return response(['status' => 1, 'message' => 'Запис видалено', 'redirect' => route('adminUsers')]);
    }
}
