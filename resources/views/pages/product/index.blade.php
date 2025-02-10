@extends('layouts.main')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold">Product</h1>
        <ul class="flex items-center text-sm">
            <li class="mr-2">
                <a href="" class="text-gray-400 hover:text-gray-600 font-medium">Home</a>
            </li>
            <li class="mr-2 text-gray-600 font-medium">/</li>
            <li class="mr-2 ">
                <a href="" class="text-gray-600 font-medium">Product</a>
            </li>
        </ul>
    </div>

    <div class="bg-white border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
        <div class="flex mb-6">
            <a href="/product/create" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-md">Tambah Data</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[540px]">
                <thead>
                    <tr class="bg-gray-50 text-left rounded-md">
                        <th class="text-md font-bold py-2 px-4">
                            No</th>
                        <th class="text-md font-bold py-2 px-4 ">
                            Rayon</th>
                        <th class="text-md font-bold py-2 px-4 ">
                            Pembimbing Siswa</th>
                        <th class="text-md font-bold py-2 px-4 ">
                            Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b border-b-gray-50">1</td>
                        <td class="py-2 px-4 border-b border-b-gray-50">Handphone</td>
                        <td class="py-2 px-4 border-b border-b-gray-50">Rp3.900.00</td>
                        <td class="py-2 px-4 border-b border-b-gray-50">80</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-b-gray-50">2</td>
                        <td class="py-2 px-4 border-b border-b-gray-50">Laptop</td>
                        <td class="py-2 px-4 border-b border-b-gray-50">Rp13.900.00</td>
                        <td class="py-2 px-4 border-b border-b-gray-50">20</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection