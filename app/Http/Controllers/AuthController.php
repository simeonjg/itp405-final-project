<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    // Log user out
    public function logout()
    {
        Auth::logout(); //session_destroy()

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

        // $loginWasSuccessful = Auth::attempt([
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password'),
        // ]);

        // validation for input fields
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // authentication of credentials
        if (Auth::attempt($validated)) {
            return redirect()->route('search.home');
        } else {
            return back()
                ->withInput()
                ->with('error', 'Invalid Credentials');
        }

        

        // if($loginWasSuccessful) {
        //     return redirect()->route('profile.index');
        // } else {
        //     return redirect()->route('auth.login')->with('error', 'Invalid credentials');
        // }
    }
}
