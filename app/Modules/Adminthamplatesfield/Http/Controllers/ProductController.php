<?php

namespace App\Modules\Adminthamplatesfield\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use App\Traits\SaveTrait;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    use SaveTrait;
    private $form = [
        'name' => ['required', 'max' => '30'],
    ];

    public function show()
    {
        $products = Product::orderByDesc('id')->paginate('10');

        return view('adminthamplatesfield::productShow')->with(['products' => $products]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {

            return $this->save(Product::class);
        }
//        return view('adminthamplatesfield::add');
    }

    public function edit(Request $request, $id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        if ($request->isMethod('POST')) {

            return $this->save($product);
        }
        return view('adminthamplatesfield::productEdit')->with(['product' => $product]);
    }

    public function createResponse($instance, $callbackResult)
    {
        return response(['status' => 1, 'message' => 'Запис успішно додано', 'redirect' => route('adminProducts')]);
    }

    public function delete(Request $request)
    {

        Product::findOrFail($request->input('id'))->delete();

        return response(['status' => 1, 'message' => 'Запис видалено', 'redirect' => route('adminProducts')]);
    }
}
