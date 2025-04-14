<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<!--  ================================ SaleController  ================================ -->

<!-- <?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DetailSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();
        $details = DetailSale::all();

        return view('pages.sale.index', compact('sales', 'details'));
    }

    public function detail(Request $request, $id)
    {
        $details = DetailSale::where('sale_id', $id)->get();
        $sales = Sale::findOrFail($id);

        $totalBeforeDiscount = $details->sum('subtotal');

        return view('pages.sale.detail', compact('details', 'sales', 'totalBeforeDiscount'));
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

        return view('pages.sale.member', compact('details', 'sales', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function session(Request $request)
    {
        // dd($request->all()); 

        session(['cart' => array_filter($request->products, fn($p) => $p['quantity'] > 0)]);

        return redirect()->route('sale.post');
    }

    public function store(Request $request)
    {
        // dd($request->all()); 

        $validated = $request->validate([
            'sale_date' => 'required',
            'total_price' => 'required',
            'total_pay' => 'required',
            // 'total_return' => 'required',
            'point' => 'nullable',
            'total_point' => 'nullable',
            'customer_id' => 'nullable',
            'user_id' => 'required',
            'no_hp' => 'required'
        ]);

        $total_return = $request->input('total_pay') - $request->input('total_price');

        $validated['total_return'] = $total_return;

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

        $validated['customer_id'] = $customer_id;

        $sales['customer_id'] = $customer_id;

        $is_member = $request->member_status === 'member';

        if($is_member && $customer_id) {
            $point = floor($sales['total_price'] / 100);
            $sales['point'] = $point;
            $sales['total_point'] = $point;

            Customer::where('id', $customer_id)->update([
                'point' => DB::raw("point + $point")
            ]);
        } else {
            $sales['point'] = 0;
            $sales['total_point'] = 0;
        }

        // dd($total_return);

        $sale = Sale::create($validated);

        foreach ($request->products as $product) {
            DetailSale::create([
                'sale_id' => $sale->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'subtotal' => $product['price'] * $product['quantity']
            ]);

            Product::where('id', $product['id'])->decrement('stock', $product['quantity']);
        }

        if ($is_member) {
            return redirect()->route('sale.member', $sale->id);
        }

        return redirect()->route('sale.detail', $sale->id);
    }

    public function saveMember(Request $request, $id) {
        $request->validate([
            'name' => 'required'
        ]); 

        $sale = Sale::findOrFail($id);
        $customer = Customer::findOrFail($sale->customer_id);
        $usePoint = $request->has('use_point');
        $point = $customer->point;
        $total = $sale->total_price;

        $customer->name = $request->name;

        if ($usePoint) {
            if($point >= $total) {
                $sale->total_price = 0;
                $customer->point = $point - $total;
            } else {
                $sale->total_price = $total - $point;
                $customer->point = 0;
            }
        }
        

        $customer->save();
        $sale->save();

        return redirect()->route('sale.detail', $sale->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
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
 -->


<!--  ================================ ProductController  ================================ -->

<!-- <?php

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
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        $products = $query->get();

        return view('pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.product.create');
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
 -->

<!--  ================================ UserController  ================================ -->

<!-- <?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('pages.user.index', compact('users'));
    }

    public function create() {
        return view('pages.user.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create($validated);

        return redirect('/user')->with('success', 'Data user berhasil ditambahkan');
    }

    public function edit($id) 
    {
        $user = User::findOrFail($id);

        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);

        if(!$request->filled('password')){
            $validated['password'] = $user->password;
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return redirect('/user')->with('success', 'Data user berhasil diupdate');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        if($user) {
            $user->delete();
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } else {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }
    }
}
 -->


<!-- ================================ AuthController  ================================ -->

<!-- <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah!'])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
 
 -->

 <!-- Dashboard Controller 


<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSale = Sale::count();
        $totalProduct = Product::count();
        $totalUser = User::count();

        // Ambil data penjualan per hari
        $sales = DB::table('sales')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date')
            ->get();


        // Siapkan data untuk chart
        $labels = $sales->pluck('date');
        $dataChart = $sales->pluck('total');

        return view('pages.dashboard.index', compact(
            'totalSale',
            'totalProduct',
            'totalUser',
            'labels',
            'dataChart'
        ));
    }
}


-->
 

 <!-- public function collection()
    {
        return Sale::select('id', 'sale_date', 'total_price', 'total_pay', 'total_return', 'point', 'user_id', 'customer_id')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal Penjualan',
            'Total Harga',
            'Total Bayar',
            'Kembalian',
            'Point',
            'ID User',
            'ID Customer',
        ];
    } 
    
    -->
<!-- 

<script>
        const labels = @json($labels);
        const data = @json($dataChart);
    
        new Chart(document.getElementById('myChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Penjualan per Hari',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

-->
<!-- 

<?php

use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('login');
});

Route::middleware(['IsGuest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login/store', [AuthController::class, 'store'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['IsLogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');

    Route::get('/export-sales', function () {
        return Excel::download(new SalesExport, 'sales.xlsx');
    })->name('sales.export');


    Route::middleware(['IsAdmin'])->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.delete');

        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');

        Route::get('/product/edit-modal', [ProductController::class, 'editModal'])->name('product.editModal');
        Route::patch('/product/{id}', [ProductController::class, 'updateModal'])->name('product.updateModal');
    });

    Route::middleware(['IsEmployee'])->group(function () {
        Route::get('sale/create', [SaleController::class, 'create'])->name('sale.create');
        Route::get('sale/create/post', [SaleController::class, 'post'])->name('sale.post');
        Route::get('sale/create/member/{id}', [SaleController::class, 'member'])->name('sale.member');
        Route::post('sale/session', [SaleController::class, 'session'])->name('sale.session');
        Route::post('sale/store', [SaleController::class, 'store'])->name('sale.store');
        Route::get('sale/detail-print/{id}', [SaleController::class, 'detail'])->name('sale.detail');
        Route::post('sale/member/{id}', [SaleController::class, 'saveMember'])->name('sale.save.member');
    });
});


-->
    

<!-- <script>
    document.querySelectorAll('.btn-plus').forEach(button => {
        button.addEventListener('click', function() {
            let productId = this.getAttribute('data-id');
            let quantityElement = document.getElementById('quantity-' + productId);
            let inputElement = document.getElementById('input-quantity-' + productId);
            let price = parseInt(document.querySelector(`input[name="products[${productId}][price]"]`).value);
            let stock = parseInt(document.querySelector(`p[data-stock="${productId}"]`).textContent.replace(/\D/g, ''));
            let subtotalElement = document.getElementById('subtotal-' + productId);

            let quantity = parseInt(quantityElement.textContent);

            if (quantity < stock) {
                quantity += 1;
                quantityElement.textContent = quantity;
                inputElement.value = quantity;
                subtotalElement.textContent = 'Rp' + (quantity * price).toLocaleString('id-ID');
            }
        });
    });

    document.querySelectorAll('.btn-minus').forEach(button => {
        button.addEventListener('click', function() {
            let productId = this.getAttribute('data-id');
            let quantityElement = document.getElementById('quantity-' + productId);
            let inputElement = document.getElementById('input-quantity-' + productId);
            let price = parseInt(document.querySelector(`input[name="products[${productId}][price]"]`).value);
            let subtotalElement = document.getElementById('subtotal-' + productId);

            let quantity = Math.max(0, parseInt(quantityElement.textContent) - 1);
            quantityElement.textContent = quantity;
            inputElement.value = quantity;
            subtotalElement.textContent = 'Rp' + (quantity * price).toLocaleString('id-ID');
        });
    });
</script> -->

<!-- <input type="hidden" name="products[{{ $product->id }}][id]" value="{{ $product->id }}"> -->
