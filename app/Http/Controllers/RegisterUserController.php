<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function create() {
        return view('register_user.form')
            ->with('user', null);
    }

    public function store(Request $request) {
        $attributes = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create($attributes);

        // If the currently logged in user is admin, redirect to admin dashboard
        if(auth()->user()?->isAdmin()) {
            return redirect('/admin');
        }

        // Otherwise, log the newly created user in and redirect to home page
        auth()->login($user);
        return redirect('/');
    }

    public function edit (User $user) {
        return view('register_user.form', ['user' => $user]);
    }

    public function update (Request $request, User $user) {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => ['required', 'unique:users,email,'.$user->id],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $user->update($attributes);

        // Set a flash message
        session()->flash('success','User Updated Successfully');

        return redirect('/admin');
    }

    public function destroy (User $user) {
        $user->delete();

        // Set a flash message
        session()->flash('success','User Deleted Successfully');

        return redirect('/admin');
    }
}
