<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Symfony\Component\VarDumper\Caster\PdoCaster;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        return Product::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        dd($request->validated());
        return $product->updateOrFail($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return $product->deleteOrFail();
    }

    // custom function start

    public function indexWithCategory()
    {
        return Product::with('category')->get();
    }

    public function showWithCategory($product_id)
    {
        return Product::with('category')->where('id', $product_id)->get();
    }

    public function showByCategory($category_id)
    {
        return Product::whereHas('category', function ($query) use ($category_id) {
            $query->where('id', $category_id);
        })->with('category')->get();
    }

    public function updateMutiple(ProductRequest $request)
    {
        dd('ok');
        // foreach ($request->input() as $data) {
        //     Product::findOrFail($data['id'])->updateOrFail($data);
        //     dump($data['id']);
        // }
    }

    // custom function end
}
