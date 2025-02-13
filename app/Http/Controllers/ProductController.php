<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('pages.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('product_images', 'public');
        }

        Product::create($validated);

        return redirect('/product')->with('success', 'Data produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $products = Product::findOrFail($id);

        return view('pages.product.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ]);

        $products = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($products->image) {
                \Storage::disk('public')->delete($products->image);
            }

            $validated['image'] = $request->file('image')->store('product_images', 'public');
        } else {
            $validated['image'] = $products->image;
        }

        $products->update($validated);

        return redirect('/product')->with('success', 'Data produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        $products = Product::findOrFail($id);

        if($products) {
            $products->delete();
            return redirect('/product')->with('success', 'Data product berhasil dihapus');
        } else {
            return redirect('/product')->with('error', 'Data product tidak ditemukan');
        }
    }
}
