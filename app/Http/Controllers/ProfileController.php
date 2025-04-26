<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;


class ProfileController extends Controller
{
    // Display profile view
    public function index()
    {
        return view('profile.index', [
            'user' => Auth::user(),
        ]);
    }

    // Edit Profile
    public function update(Request $request) {
        $user = Auth::user();

        // input field validation
        $request->validate([
            'first-name' => 'required|max:50',
            'last-name' => 'required|max:50',
            'email' => 'required|email',
            'username' => 'required|max:20|unique:users,username,'.$user->id,
        ]);

        // update user in database
        $user->first_name = $request->input('first-name');
        $user->last_name = $request->input('last-name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->is_subscribed = $request->input('is-subscribed', false);
        $user->save();


        return redirect()
            ->route('profile.index')
            ->with('success', "Successfully updated profile for {$request->input('username')}");
    }



    public function createToken(Request $request)
    {
        $token = Auth::user()->createToken($request->input('token_name'));
        
        return redirect()->route('profile.index')->with('plainTextToken', $token->plainTextToken);
    }

    public function revokeToken($tokenId)
    {
        Auth::user()->tokens()->where('id', '=', $tokenId)->delete();

        return redirect()->route('profile.index');
    }
}
