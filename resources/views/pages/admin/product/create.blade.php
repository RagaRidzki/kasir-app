@extends('layouts.main')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-textColor">Tambah data produk</h1>
            <ul class="flex items-center text-sm">
                <li class="mr-2">
                    <a href="" class="text-gray-400 hover:text-gray-600 font-medium">Home</a>
                </li>
                <li class="mr-2 text-gray-400 hover:text-gray-600 font-medium">/</li>
                <li class="mr-2">
                    <a href="" class="text-gray-400 hover:text-gray-600 font-medium">Data Produk</a>
                </li>
                <li class="mr-2 text-gray-400 hover:text-gray-600 font-medium">/</li>
                <li class="mr-2">
                    <a href="" class="text-gray-600 font-medium">Tambah Data Poduk</a>
                </li>
            </ul>
        </div>

        <div class="mb-6 bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <form action="/product/store" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                @method('POST')
                <div class="flex flex-col">
                    <div class="w-full mb-4">
                        <label for="name" class="block text-gray-600 font-semibold mb-2">Nama Produk <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" class="block w-full border border-gray-300 focus:outline-none focus:border-gray-700 py-2 px-4 ">
                    </div>
                    <div class="w-full mb-4">
                        <label for="price" class="block text-gray-600 font-semibold mb-2">Harga <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" class="block w-full border border-gray-300 focus:outline-none focus:border-gray-600 py-2 px-4">
                    </div>
                    <div class="w-full mb-4">
                        <label for="stock" class="block text-gray-600 font-semibold mb-2">Stok <span class="text-red-500">*</span></label>
                        <input type="text" id="stock" name="stock" class="block w-full border border-gray-300 focus:outline-none focus:border-gray-600 py-2 px-4">
                    </div>
                    <div class="w-full mb-4">
                        <label for="image" class="block text-gray-600 font-semibold mb-2">Gambar <span class="text-red-500">*</span></label>
                        <input type="file" id="image" name="image" class="block w-full border border-gray-300 focus:outline-none focus:border-gray-600 py-2 px-4">
                    </div>
                </div>
                <div class="flex justify-end gap-x-2">
                    <button type="submit" class="py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white rounded-md"><i class="ri-add-line"></i> Tambah Produk</button>
                    <a href="/product" class="py-2 px-4 bg-gray-500 hover:bg-gray-700 text-white rounded-md">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection