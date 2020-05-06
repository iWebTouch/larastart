<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('show_profile', ['user' => $user]);
    }

    public function edit()
    {
        $user = auth()->user();

        return view('edit_profile', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'passwd' => 'nullable|min:4',
            'passwd_confirmation' => 'same:passwd'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('passwd') != '') {
            $user->password = Hash::make($request->input('passwd'));
        }

        $user->save();

        return back()->with('status', 'Profile has been saved.');
    }
}
