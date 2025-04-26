<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;

class RegistrationController extends Controller
{
    // Display registration view
    public function index()
    {
        return view('registration.index');
    }

    // Validate input and register user
    public function register(Request $request)
    {
        // input field validation
        $request->validate([
            'first-name' => 'required|max:50',
            'last-name' => 'required|max:50',
            'email' => 'required|email',
            'username' => 'required|max:20|unique:users',
            'password' => 'required'
        ]);


        $user = new User();
        $user->first_name = $request->input('first-name');
        $user->last_name = $request->input('last-name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->is_subscribed = $request->input('is-subscribed', false);
        $user->save();

        Auth::login($user);

        return redirect()
            ->route('search.home')
            ->with('success', "Your account has been created. Welcome, {$user->username}!");

    }
}
