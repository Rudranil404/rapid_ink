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

    public function updateHomepage(Request $request)
    {
        $data = $request->except(['_token']);

        // 1. Handle Slide Deletions
        if (!empty($data['deleted_slides'])) {
            $deletedSlides = explode(',', $data['deleted_slides']);
            foreach ($deletedSlides as $slideId) {
                if (empty($slideId)) continue;
                $keysToDelete = \App\Models\Setting::where('key', 'like', "slide{$slideId}\_%")->get();
                foreach ($keysToDelete as $setting) {
                    if (str_contains($setting->key, '_image') && $setting->value) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($setting->value);
                    }
                    $setting->delete();
                }
            }
        }
        unset($data['deleted_slides']);

        // 2. Handle Category Deletions
        if (!empty($data['deleted_categories'])) {
            $deletedCats = explode(',', $data['deleted_categories']);
            foreach ($deletedCats as $catId) {
                if (empty($catId)) continue;
                $keysToDelete = \App\Models\Setting::where('key', 'like', "cat{$catId}\_%")->get();
                foreach ($keysToDelete as $setting) {
                    if (str_contains($setting->key, '_image') && $setting->value) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($setting->value);
                    }
                    $setting->delete();
                }
            }
        }
        unset($data['deleted_categories']);

        // 3. Process Standard Updates & New Uploads
        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $oldSetting = \App\Models\Setting::where('key', $key)->first();
                if ($oldSetting && $oldSetting->value) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($oldSetting->value);
                }
                $path = $request->file($key)->store('homepage', 'public');
                \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $path]);
            } else {
                // FIX: If a text field is left empty, save it as an empty string instead of ignoring it.
                // This ensures the database knows the category/slide block exists!
                \App\Models\Setting::updateOrCreate(
                    ['key' => $key], 
                    ['value' => $value ?? ''] 
                );
            }
        }

        return back()->with('success', 'Homepage settings updated successfully!');
    }
}