<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    // Log user out
    public function logout()
    {
        Auth::logout(); 

        return redirect()->route('auth.login');
    }

    // Display login form
    public function loginForm()
    {
        return view('auth.login');
    }

    // Authenticate/Validate Login
    public function login(Request $request)
    {

        // Or alidation for input fields
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Authentication of credentials
        if (Auth::attempt($validated)) {
            return redirect()->route('search.home');
        } else {
            return back()
                ->withInput()
                ->with('error', 'Invalid Credentials');
        }
    }
}
