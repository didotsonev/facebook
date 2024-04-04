<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::get();

        return view('users', compact('users'));
    }

    public function show(Request $request, User $user)
    {
        return view('user', compact('user'));
    }

    public function store(Request $request)
    {
        User::create([
            'name' => 'test',
            'email' => 'test@aa.aa',
            'password' => bcrypt("password"),
        ]);
    }

    public function create(Request $request)
    {
        return view('create');
    }

    public function edit(Request $request, User $user)
    {
        return view('edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user) {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
    }
}
