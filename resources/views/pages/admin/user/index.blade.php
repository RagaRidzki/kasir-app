@extends('layouts.main')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-textColor">Data User</h1>
        <ul class="flex items-center text-sm">
            <li class="mr-2">
                <a href="" class="text-gray-400 hover:text-gray-600 font-medium">Home</a>
            </li>
            <li class="mr-2 text-gray-600 font-medium">/</li>
            <li class="mr-2 ">
                <a href="" class="text-gray-600 font-medium">User</a>
            </li>
        </ul>
    </div>

    <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
        <div class="flex justify-end mb-6">
            <a href="/user/create" class="py-2 px-4 bg-blue-500 hover:bg-blue-700 rounded-md text-white">Tambah User</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[540px]">
                <thead>
                    <tr class="bg-gray-50 text-left rounded-sm">
                        <th class="text-md font-bold py-2 px-4">No</th>
                        <th class="text-md font-bold py-2 px-4">Email</th>
                        <th class="text-md font-bold py-2 px-4">Nama</th>
                        <th class="text-md font-bold py-2 px-4">Role</th>
                        <th class="text-md font-bold py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="py-2 px-4 border-b border-b-gray-200">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">{{ $user->name }}</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">{{ $user->role }}</td>
                        <td class="py-2 px-4 border-b border-b-gray-200">
                            <ul class="flex items-center gap-x-2">
                                <li>
                                    <a {{-- href="/user/edit/{{ $users->id }}" --}}
                                        class="py-2 px-4 bg-yellow-500 hover:bg-yellow-700 text-white rounded-md">Edit</a>
                                </li>
                                <li>
                                    <form {{-- action="/user/{{ $users->id }}" --}} method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="py-2 px-4 bg-red-500 hover:bg-red-700 text-white rounded-md">Hapus</button>
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
@endsection