<?php

namespace App\Modules\Adminthamplatesfield\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Manipulation;
use App\Traits\SaveTrait;
use Illuminate\Http\Request;

class ManipulationController extends Controller
{
    use SaveTrait;
    private $form = [
        'name' => ['required', 'max' => '30'],
    ];

    public function show()
    {
        $manipulations = Manipulation::orderByDesc('id')->paginate('10');

        return view('adminthamplatesfield::manipulationShow')->with(['manipulations' => $manipulations]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {

            return $this->save(Manipulation::class);
        }
//        return view('adminthamplatesfield::add');
    }

    public function edit(Request $request, $id)
    {
        $manipulation = Manipulation::where('id', $id)->firstOrFail();

        if ($request->isMethod('POST')) {

            return $this->save($manipulation);
        }
        return view('adminthamplatesfield::manipulationEdit')->with(['manipulation' => $manipulation]);
    }

    public function createResponse($instance, $callbackResult)
    {
        return response(['status' => 1, 'message' => 'Запис успішно додано', 'redirect' => route('adminManipulations')]);
    }

    public function delete(Request $request)
    {

        Manipulation::findOrFail($request->input('id'))->delete();

        return response(['status' => 1, 'message' => 'Запис видалено', 'redirect' => route('adminManipulations')]);
    }
}
