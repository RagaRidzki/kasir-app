<?php

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
