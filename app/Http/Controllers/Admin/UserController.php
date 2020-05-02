<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return view('admin/users');
    }

    public function data()
    {
        $users = User::select(['id', 'name', 'email', 'is_admin']);
        
        return DataTables::of($users)
                ->addColumn('action', function($user) {
                    return '<a href="'.route('edit.user', $user->id).'" class="btn btn-sm btn-success">
                                <i class="fa fa-pen"></i> Edit
                            </a>
                            <a href="'.route('delete.user', $user->id).'" class="btn btn-sm btn-danger">
                                <i class="fa fa-times"></i> Delete
                            </a>';
                })
                ->addColumn('role', function($user) {
                    return $user->is_admin == 1? 'Admin' : '';
                })
                ->addColumn('status', 'Active')
                ->make(true);
    }
}
