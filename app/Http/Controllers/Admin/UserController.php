<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin/users');
    }

    public function add()
    {
        return view('admin/user', [
            'page' => ['title' => 'Add User'],
            'form' => ['action' => route('create.user'), 'method' => 'POST'],
            'user' => null,
            'user_statuses' => User::$statuses,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'passwd' => 'required|min:4',
            'passwd_confirmation' => 'same:passwd'
        ]);

        if ($request->input('passwd') == '') {
            $inputs = $request->except('passwd');
        } else {
            $inputs = $request->all();
            $inputs['password'] = Hash::make($inputs['passwd']);
        }
        User::create($inputs);

        return redirect()->route('manage.users');
    }

    public function edit(User $user)
    {
        return view('admin/user', [
            'page' => ['title' => 'Edit User'],
            'form' => ['action' => route('update.user', $user->id), 'method' => 'PUT'], 
            'user' => $user,
            'user_statuses' => User::$statuses,
        ]);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'passwd' => 'nullable|min:4',
            'passwd_confirmation' => 'same:passwd'
        ]);

        if ($request->input('passwd') == '') {
            $inputs = $request->except('passwd');
        } else {
            $inputs = $request->all();
            $inputs['password'] = Hash::make($inputs['passwd']);
        }
        $user->update($inputs);
        
        return back()->with('status', 'Data have been saved.');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }

    public function data()
    {
        $users = User::select(['id', 'name', 'email', 'is_admin', 'status']);
        
        return DataTables::of($users)
                ->addColumn('action', function($user) {
                    return '<a href="'.route('edit.user', $user->id).'" class="btn btn-sm btn-success">
                                <i class="fa fa-pen"></i> Edit
                            </a>
                            <a href="'.route('delete.user', $user->id).'" class="btn btn-sm btn-danger" 
                                data-method="DELETE" 
                                data-confirm="Are you sure want to delete?" 
                                data-token="'.csrf_token().'">
                                <i class="fa fa-times"></i> Delete
                            </a>';
                })
                ->addColumn('role', function($user) {
                    return $user->is_admin == 1? 'Admin' : '';
                })
                ->editColumn('status', function($user) { 
                    return User::$statuses[$user->status]; 
                })
                ->make(true);
    }
}
