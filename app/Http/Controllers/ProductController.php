<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
    public function index()
    {
        $products = product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }
    public function edit(product $product)
    {
        return view('products.edit', ['product' => $product]);
    }
    public function update(product $product, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'qty' => 'required|numeric',
            'price' => 'required|gte:0|lte:99999'
        ]);

        $product->update($data);
        return redirect(route("product.index"))->with('sucess', "Producted updated sucessfully");
    }
    public function destroy(product $product)
    {
        $product->delete();
        return redirect(route("product.index"))->with('sucess', "Producted deleted sucessfully");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'qty' => 'required|numeric',
            'price' => 'required|gte:0|lte:99999'
        ]);

        $newProduct = product::create($data);
        return redirect(route("product.index"));
    }
}
