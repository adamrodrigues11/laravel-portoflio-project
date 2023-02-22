<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create() {
        return view('sessions.create');
    }

    public function store() {
        // validate form data
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attempt login via auth helper
        if (auth()->attempt($attributes)) {
            // set a flash message
            $message = 'Welcome back, ' . auth()->user()->name . '!';
            session()->flash('success', $message);
            
            // session()->regenerate();
            return redirect('/');
            // ->with('success', 'Welcome back!');
        }

        // handle auth attempt failure
        return back()
            ->withInput()
            ->withErrors(['email' => 'Email or Password is incorrect.']);
    }

    public function destroy() {
        auth()->logout();

        return redirect('/');
    }
}
