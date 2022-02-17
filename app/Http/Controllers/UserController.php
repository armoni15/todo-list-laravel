<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:40|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('succes', 'Registration successfull! Please login');
    }
}
