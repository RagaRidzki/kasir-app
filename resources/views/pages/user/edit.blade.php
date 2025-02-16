@extends('layouts.main')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-textColor">Edit data user</h1>
        <ul class="flex items-center text-sm">
            <li class="mr-2">
                <a href="" class="text-gray-400 hover:text-gray-600 font-medium">Home</a>
            </li>
            <li class="mr-2 text-gray-400 hover:text-gray-600 font-medium">/</li>
            <li class="mr-2">
                <a href="" class="text-gray-400 hover:text-gray-600 font-medium">Data user</a>
            </li>
            <li class="mr-2 text-gray-400 hover:text-gray-600 font-medium">/</li>
            <li class="mr-2">
                <a href="" class="text-gray-600 font-medium">Edit Data Poduk</a>
            </li>
        </ul>
    </div>

    <div class="mb-6 bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
        <form action="/user/{{ $user->id }}" method="POST" enctype="multipart/form-data" class="w-full">
            @csrf
            @method('PUT')
            <div class="flex flex-col">
                <div class="w-full mb-4">
                    <label for="name" class="block text-gray-600 font-semibold mb-2">Nama <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name"
                        class="block w-full border border-gray-300 focus:outline-none focus:border-gray-700 py-2 px-4"
                        value="{{ old('name', $user->name) }}">
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full mb-4">
                    <label for="email" class="block text-gray-600 font-semibold mb-2">Email <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="email" name="email"
                        class="block w-full border border-gray-300 focus:outline-none focus:border-gray-600 py-2 px-4"
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full mb-4">
                    <label for="role" class="block text-gray-600 font-semibold mb-2">Role <span
                            class="text-red-500">*</span></label>
                    <select
                        class="appearance-none block w-full border border-gray-300 focus:outline-none focus:border-gray-600 rounded py-3 px-4 leading-tight"
                        id="role" name="role">
                        <option selected disabled>-- Pilih Role --</option>
                        <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Employee" {{ old('role', $user->role) == 'Employee' ? 'selected' : '' }}>Employee
                        </option>
                    </select>
                    @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full mb-4">
                    <label for="password" class="block text-gray-600 font-semibold mb-2">Password <span
                            class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password"
                        class="block w-full border border-gray-300 focus:outline-none focus:border-gray-600 py-2 px-4">
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end gap-x-2">
                <button type="submit" class="py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white rounded-md"><i
                        class="ri-add-line"></i> Update User</button>
                <a href="/product" class="py-2 px-4 bg-gray-500 hover:bg-gray-700 text-white rounded-md">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection