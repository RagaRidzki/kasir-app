@extends('layouts.main')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-textColor">Data Penjualan</h1>
        <ul class="flex items-center text-sm">
            <li class="mr-2">
                <a href="" class="text-gray-400 hover:text-gray-600 font-medium">Home</a>
            </li>
            <li class="mr-2 text-gray-600 font-medium">/</li>
            <li class="mr-2 ">
                <a href="" class="text-gray-600 font-medium">Penjualan</a>
            </li>
        </ul>
    </div>

    <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
        <div class="mb-6">
            <a href="" class="py-2 px-4 bg-green-500 hover:bg-green-700 rounded-md text-white">Export Penjualan (.xlsx)</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[540px]">
                <thead>
                    <tr class="bg-gray-50 text-left rounded-sm">
                        <th class="text-md font-bold py-2 px-4">No</th>
                        <th class="text-md font-bold py-2 px-4">Nama Pelanggan</th>
                        <th class="text-md font-bold py-2 px-4">Tanggal Penjualan</th>
                        <th class="text-md font-bold py-2 px-4">Total Harga</th>
                        <th class="text-md font-bold py-2 px-4">Dibuat Oleh</th>
                        <th class="text-md font-bold py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <td class="py-2 px-4 border-b border-b-gray-200">1</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">Raga Ridzki Panuntun</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">2/11/2025</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">Rp6.000.000</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">Petugas</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">
                            <ul class="flex items-center gap-x-2">
                                <li class="py-2 px-4 bg-yellow-500 hover:bg-yellow-700 text-white rounded-md">Lihat</li>
                                <li class="py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Unduh Bukti</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection