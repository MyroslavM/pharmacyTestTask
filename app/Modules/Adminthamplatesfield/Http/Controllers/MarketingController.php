<?php

namespace App\Modules\Adminthamplatesfield\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\SaveTrait;
use App\Where;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    use SaveTrait;
    private $form = [
        'name' => ['required', 'max' => '30'],
    ];

    public function show()
    {
        $marketings = Where::orderByDesc('id')->paginate('10');

        return view('adminthamplatesfield::marketingShow')->with(['marketings' => $marketings]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {

            return $this->save(Where::class);
        }
//        return view('adminthamplatesfield::add');
    }

    public function edit(Request $request, $id)
    {
        $marketing = Where::where('id', $id)->firstOrFail();

        if ($request->isMethod('POST')) {

            return $this->save($marketing);
        }
        return view('adminthamplatesfield::marketingEdit')->with(['marketing' => $marketing]);
    }

    public function createResponse($instance, $callbackResult)
    {
        return response(['status' => 1, 'message' => 'Запис успішно додано', 'redirect' => route('adminMarketings')]);
    }

    public function delete(Request $request)
    {

        Where::findOrFail($request->input('id'))->delete();

        return response(['status' => 1, 'message' => 'Запис видалено', 'redirect' => route('adminMarketings')]);
    }
}
