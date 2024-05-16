<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a view of the resource.
     */
    public function index()
    {
        return view('app');
    }

    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        return Product::all();
    }

    /**
     * Update the all resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'products.*.name' => ['required', 'string'],
            'products.*.amount' => ['required', 'integer'],
            'products.*.price' => ['required', 'numeric'],
            'new_products.*.name' => ['required', 'string'],
            'new_products.*.amount' => ['required', 'integer'],
            'new_products.*.price' => ['required', 'numeric'],
        ]);

        Product::whereNotIn('id', collect($request->products)->pluck('id'))->delete();
        Product::upsert($request->products, ['id'], ['name', 'amount', 'price']);
        Product::insert($request->new_products);

        return Product::all();
    }
}
