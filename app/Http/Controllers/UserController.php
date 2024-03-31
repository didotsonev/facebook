<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
