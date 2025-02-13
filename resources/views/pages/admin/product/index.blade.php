@extends('layouts.main')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-textColor">Data Product</h1>
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
        <div class="flex justify-end mb-6">
            <a href="/product/create" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Tambah
                Produk</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[540px]">
                <thead>
                    <tr class="bg-gray-50 text-left rounded-md">
                        <th class="text-md font-bold py-2 px-4">
                            No</th>
                        <th class="text-md font-bold py-2 px-4 ">
                            Gambar</th>
                        <th class="text-md font-bold py-2 px-4 ">
                            Nama Produk</th>
                        <th class="text-md font-bold py-2 px-4 ">
                            Harga</th>
                        <th class="text-md font-bold py-2 px-4 ">
                            Stok</th>
                        <th class="text-md font-bold py-2 px-4 ">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="py-2 px-4 border-b border-b-gray-200">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="gambar_product"
                                class="w-20 h-20 rounded-md">
                        </td>
                        <td class="py-2 px-4 border-b border-b-gray-200">{{ $product->name }}</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">{{ 'Rp' . number_format($product->price, 0,
                            ',', '.') }}</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">{{ $product->stock }}</td>
                        <td class="py-4 px-4 border-b border-b-gray-200">
                            <ul class="flex items-center gap-x-2">
                                <li>
                                    <a href="/product/edit/{{ $product->id }}"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white py-2 px-4 rounded-md">Edit</a>
                                </li>
                                <li>
                                    <a href=""
                                        class="bg-green-500 hover:bg-green-700 bg text-white py-2 px-4 rounded-md">Update
                                        Stok</a>
                                </li>
                                <li>
                                    <form action="/product/{{ $product->id }}" method="POST"
                                        id="delete-form-{{ $product->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded-md"
                                            onclick="confirmDelete({{ $product->id }})">Hapus</button>
                                    </form>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(productID) {
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: 'Data product ini akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus data ini',
        cancelButtonText: 'Batal, data tetap disimpan',
        reverseButtons: false, // Pastikan tombol merah tetap di kiri
        customClass: {
            confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded mr-2 order-1',
            cancelButton: 'bg-gray-300 hover:bg-gray-400 text-black font-semibold px-4 py-2 rounded order-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + productID).submit();
        } else {
            Swal.fire({
                title: 'Dibatalkan',
                text: 'Data product aman tersimpan.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
}
</script>
@endsection