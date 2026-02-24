<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // Display the form with existing settings
    public function editHomepage()
    {
        // Pluck all settings into a simple key => value array
        $settings = Setting::pluck('value', 'key')->toArray();
        
        return view('admin.settings.homepage', compact('settings'));
    }

    // Save the form data
    public function updateHomepage(Request $request)
    {
        $data = $request->except(['_token']);

        foreach ($data as $key => $value) {
            // Handle Image Uploads dynamically
            if ($request->hasFile($key)) {
                // Delete old image if it exists
                $oldSetting = Setting::where('key', $key)->first();
                if ($oldSetting && $oldSetting->value) {
                    Storage::disk('public')->delete($oldSetting->value);
                }
                
                // Store new image
                $path = $request->file($key)->store('homepage', 'public');
                Setting::updateOrCreate(['key' => $key], ['value' => $path]);
            } 
            // Handle Text/Standard Inputs
            else {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }

        return back()->with('success', 'Homepage settings updated successfully!');
    }
}