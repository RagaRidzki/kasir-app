<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('pages.admin.user.index', compact('users'));
    }

    public function create() {
        return view('pages.admin.user.create');
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
}
