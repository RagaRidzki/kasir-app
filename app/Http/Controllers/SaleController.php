<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DetailSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function member(Request $request, $id)
    {
        $details = DetailSale::where('sale_id', $id)->get();
        $sales = Sale::findOrFail($id);
        $customers = $sales->customer_id ? Customer::find($sales->customer_id) : null;

        return view('pages.sale.member', compact('sales', 'details', 'customers'));
    }

    public function detail(Request $request, $id)
    {
        $details = DetailSale::where('sale_id', $id)->get();
        $sales = Sale::findOrFail($id);

        $pointUsed = $sales->point;
        $totalBeforeDiscount = $details->sum('subtotal');
        $totalAfterDiscount = $sales->total_price;
        $pointUsed = $totalBeforeDiscount - $totalAfterDiscount;

        return view('pages.sale.detail', compact(
            'details',
            'sales',
            'totalBeforeDiscount',
            'totalAfterDiscount',
            'pointUsed'
        ));
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
            'no_hp' => 'nullable'
        ]);

        $customer_id = null;

        if (!empty($request->no_hp)) {
            $customer = Customer::where('no_hp', $request->no_hp)->first();

            if (!$customer) {
                $customer = Customer::create([
                    'name' => 'customer' . $request->no_hp,
                    'no_hp' => $request->no_hp,
                    'point' => 0
                ]);
            }

            $customer_id = $customer->id;
        }

        $sales['customer_id'] = $customer_id;

        $is_member = $request->member_status === 'member';

        // Hitung point jika member
        if ($is_member && $customer_id) {
            $point = floor($sales['total_price'] / 100);
            $sales['point'] = $point;
            $sales['total_point'] = $point;

            // Tambahkan point ke customer
            Customer::where('id', $customer_id)->update([
                'point' => DB::raw("point + $point")
            ]);
        } else {
            // Jika bukan member, pastikan point tetap 0
            $sales['point'] = 0;
            $sales['total_point'] = 0;
        }

        // dd($request->all());

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

        if ($is_member) {
            return redirect()->route('sale.member', ['id' => $sale->id]);
        }

        return redirect()->route('sale.detail', ['id' => $sale->id]);
    }

    public function saveMember(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $sale = Sale::findOrFail($id);
        $customer = Customer::findOrFail($sale->customer_id);

        $usePoint = $request->has('use_point');
        $point = $customer->point;
        $total = $sale->total_price;

        // Update nama customer
        $customer->name = $request->name;

        if ($usePoint) {
            if ($point >= $total) {
                // Semua biaya dibayar pakai point
                $sale->total_price = 0;
                $customer->point = $point - $total;
            } else {
                // Potong sebagian biaya sesuai point
                $sale->total_price = $total - $point;
                $customer->point = 0;
            }
        }

        $customer->save();
        $sale->save();

        return redirect()->route('sale.detail', ['id' => $id])->with('success', 'Nama member & penggunaan poin berhasil disimpan.');
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
