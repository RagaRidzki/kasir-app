@extends('layouts.main')

@section('content')
<div class="p-6">
    <x-breadcrumb title="Data Penjualan" :paths="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Data Penjualan', 'url' => '']
        ]" />


    <div class="w-full flex justify-between items-center mb-6">
        <div class="relative w-96">
            <input type="text" placeholder="Cari produk..."
                class="w-full border border-gray-300 rounded-md py-2 px-4 pl-10 focus:ring-2 focus:ring-blue-600 focus:outline-none">
            <i class="ri-search-line absolute left-3 top-2.5 w-5 h-5 text-gray-400"></i>
        </div>

        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <span class="text-gray-600 text-sm">Showing</span>
                <select
                    class="border border-gray-300 bg-white text-gray-700 rounded-md px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>

            <!-- Filter Button -->
            <button
                class="flex items-center space-x-1 border border-gray-300 px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100 text-sm">
                <i class="ri-filter-line"></i>
                <span>Filter</span>
            </button>
            <x-link-button href="#" color="green" shadow="green">
                <i class="ri-export-line"></i> Export
                Penjualan(.xlsx)
            </x-link-button>
            @if (auth()->user()->role === 'Employee')
            <x-link-button href="/sale/create" color="blue" shadow="blue">
                <i class="ri-add-line"></i> Tambah
                Penjualan
            </x-link-button>
            @endif
        </div>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm p-6 rounded-lg">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[540px] border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="text-md font-semibold py-3 px-5 border-b">No</th>
                        <th class="text-md font-semibold py-3 px-5 border-b">Nama Pelanggan</th>
                        <th class="text-md font-semibold py-3 px-5 border-b">Tanggal Penjualan</th>
                        <th class="text-md font-semibold py-3 px-5 border-b">Total Harga</th>
                        <th class="text-md font-semibold py-3 px-5 border-b">Dibuat Oleh</th>
                        @if (auth()->user()->role === 'Employee')
                        <th class="text-md font-semibold py-3 px-5 border-b">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-5 border-b">{{ $loop->iteration }}</td>
                        <td class="py-3 px-5 border-b">{{ $sale->customer_id ? '' : 'NON-MEMBER' }}
                        </td>
                        <td class="py-3 px-5 border-b">{{ $sale->sale_date }}</td>
                        <td class="py-3 px-5 border-b">Rp{{ number_format($sale->total_price, 0, ',',
                            '.') }}</td>
                        <td class="py-3 px-5 border-b">{{ $sale->user->name }}</td>
                        @if (auth()->user()->role === 'Employee')
                        <td class="py-3 px-5 border-b">
                            <ul class="flex items-center gap-x-2">
                                <li class="text-gray-500 hover:text-gray-700 cursor-pointer"><i
                                        class="ri-eye-line text-lg"></i></li>
                                <li class="text-gray-500 hover:text-gray-700 cursor-pointer"><i
                                        class="ri-download-line text-lg"></i>
                                </li>
                            </ul>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection