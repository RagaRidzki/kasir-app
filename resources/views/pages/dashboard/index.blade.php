@extends('layouts.main')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-textColor">Dashboard</h1>
        <ul class="flex items-center text-sm">
            <li class="mr-2">
                <a href="" class="text-gray-400 hover:text-gray-600 font-medium">Home</a>
            </li>
            <li class="mr-2 text-gray-600 font-medium">/</li>
            <li class="mr-2 ">
                <a href="" class="text-gray-600 font-medium">Dashboard</a>
            </li>
        </ul>
    </div>
    <div class="mb-6 gap-6 grid grid-cols-1 md:grid-cols-3">
        <div class="bg-white border-gray-100 shadow-black/5 p-6 rounded-md shadow-md">
            <div class="flex flex-col space-y-2">
                <h1 class="text-xl font-semibold mr-2">Produk: </h1>
                <h4 class="text-2xl font-semibold text-textColor">100</h4>
            </div>
        </div>
        <div class="bg-white border-gray-100 shadow-black/5 p-6 rounded-md shadow-md">
            <div class="flex flex-col space-y-2">
                <h1 class="text-xl font-semibold mr-2">User:</h1>
                <h4 class="text-2xl font-semibold text-textColor">5</h4>
            </div>
        </div>
        <div class="bg-white border-gray-100 shadow-black/5 p-6 rounded-md shadow-md">
            <div class="flex flex-col space-y-2">
                <h1 class="text-xl font-semibold">Penjualan:</h1>
                <h4 class="text-2xl font-semibold text-textColor">5000</h4>
            </div>
        </div>
    </div>
</div>
@endsection