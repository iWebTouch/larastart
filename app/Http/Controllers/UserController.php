<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Image;

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

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $user->avatar = 'ava-'.str_pad($user->id,10,'0',STR_PAD_LEFT).'.'.$avatar->getClientOriginalExtension();
            $avatar->move(public_path('imgs/'), $user->avatar);

            Image::make(public_path('imgs/') . $user->avatar)->resize(150,150)->save();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('passwd') != '') {
            $user->password = Hash::make($request->input('passwd'));
        }

        $user->save();

        return back()->with('status', 'Profile has been saved.');
    }
}
