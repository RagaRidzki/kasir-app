<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DetailSale;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();

        return view('pages.sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('pages.sale.create', compact('products'));
    }

    public function post()
    {
        $cart = session('cart', []);

        return view('pages.sale.post', compact('cart'));
    }

    public function detail(Request $request, $id)
    {
        $details = DetailSale::where('sale_id', $id)->get();
        $sales = Sale::findOrFail($id);

        return view('pages.sale.detail', compact('details', 'sales'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function session(Request $request)
    {
        session(['cart' => array_filter($request->products, fn($p) => $p['quantity'] > 0)]);

        return redirect()->route('sale.post');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $sales = $request->validate([
            'sale_date' => 'required|date',
            'total_price' => 'required|numeric',
            'total_pay' => 'required|numeric',
            'total_return' => 'required|numeric',
            'point' => 'nullable|integer',
            'total_point' => 'nullable|integer',
            'customer_id' => 'nullable|integer',
            'user_id' => 'required|integer',
        ]);

        $sale = Sale::create($sales);

        foreach ($request->products as $product) {
            DetailSale::create([
                'sale_id' => $sale->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'subtotal' => $product['price'] * $product['quantity'],
            ]);

            Product::where('id', $product['id'])->decrement('stock', $product['quantity']);
        }

        
        
    //     Customer::where('no_hp',$request->no_hp)->first();
    // if(!$customer){
    //     Customer::cre
    // }

        return redirect()->route('sale.detail', ['id' => $sale->id]);
    }

    public function showPost()
    {
        // Ambil data cart dari session (jika ada)
        $cart = session('cart', []);

        return view('pages.sale.post', compact('cart'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
