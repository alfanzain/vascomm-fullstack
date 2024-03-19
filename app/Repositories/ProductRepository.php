<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductRepository
{
    public function get(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $take = $request->input('take', 10);
        $skip = $request->input('skip', 0);

        return $query->take($take)->skip($skip)->get();
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->image = $request->input('image');
        $product->status = $request->input('status');
        $product->save();

        return $product;
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->image = $request->input('image');
        $product->status = $request->input('status');
        $product->save();

        return $product;
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
}
