<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'username' => 'required|max:20|unique:users,username',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|confirmed|min:5'
        ]);

        //store user
        User::create([
            'username' => trim($request->username),
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password)
        ]);

        //sign user in
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);

        //redirect
        return redirect()->route('home');
    }
}
