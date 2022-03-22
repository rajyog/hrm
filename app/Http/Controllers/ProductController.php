<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        if (\Auth::user()->can('Manage Product')) {
            $products = Product::latest()->paginate(5);
            return view('products.index', compact('products'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->can('Create Product')) {
            return view('products.create');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', __('Product created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (\Auth::user()->can('Edit Product')) {
            return view('products.edit', compact('product'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', __('Product updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (\Auth::user()->can('Delete Product')) {
            $product->delete();

            return redirect()->route('products.index')
                ->with('success', __('Product deleted successfully'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
