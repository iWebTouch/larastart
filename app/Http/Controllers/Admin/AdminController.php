<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function settings()
    {
        $settings = Settings::firstOrNew();

        return view('admin/settings', ['settings' => $settings]);
    }

    public function updateSettings(Request $request)
    {
        $settings = Settings::firstOrNew();

        $settings->fill($request->all());
        $settings->save();

        return back()->with('status', 'Settings have been saved.');
    }
}
