<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Image;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function settings()
    {
        $settings = Setting::firstOrNew([]);

        return view('admin/settings', ['settings' => $settings]);
    }

    public function updateSettings(Request $request)
    {
        $settings = Setting::firstOrNew([]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $settings->logo = 'logo.'.$logo->getClientOriginalExtension();
            $logo->move(public_path('imgs/'), $settings->logo);
        }

        $settings->fill($request->except('logo'));
        $settings->save();

        return back()->with('status', 'Settings have been saved.');
    }
}
