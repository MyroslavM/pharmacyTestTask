<?php

namespace App\Modules\Adminthamplatesfield\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Service;
use App\Traits\SaveTrait;
use Illuminate\Http\Request;


class ServicesController extends Controller
{
    use SaveTrait;
    private $form = [
        'name' => ['required', 'max' => '30'],
    ];

    public function show()
    {
        $services = Service::orderByDesc('id')->paginate('10');

        return view('adminthamplatesfield::servicesShow')->with(['services' => $services]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {

            return $this->save(Service::class);
        }
//        return view('adminthamplatesfield::add');
    }

    public function edit(Request $request, $id)
    {
        $service = Service::where('id', $id)->firstOrFail();

        if ($request->isMethod('POST')) {

            return $this->save($service);
        }

        return view('adminthamplatesfield::servicesEdit')->with(['service' => $service]);
    }

    public function createResponse($instance, $callbackResult)
    {
        return response(['status' => 1, 'message' => 'Запис успішно додано', 'redirect' => route('adminServices')]);
    }

    public function delete(Request $request)
    {

        Service::findOrFail($request->input('id'))->delete();

        return response(['status' => 1, 'message' => 'Запис видалено', 'redirect' => route('adminServices')]);
    }
}
