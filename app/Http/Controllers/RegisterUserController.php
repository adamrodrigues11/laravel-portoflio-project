<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function create() {
        return view('register_user.create');
    }

    public function store(Request $request) {
        $attributes = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create($attributes);

        auth()->login($user);

        return redirect('/');
            // ->with('success', 'Your account has been created.');
    }
}
