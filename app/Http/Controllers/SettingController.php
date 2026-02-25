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

        // 1. Handle Slide Deletions (With strict PHP filtering to avoid SQL wildcard bugs)
        if (!empty($data['deleted_slides'])) {
            $deletedSlides = explode(',', $data['deleted_slides']);
            foreach ($deletedSlides as $slideId) {
                $slideId = trim($slideId);
                if (empty($slideId)) continue;
                
                // Fetch broadly, but delete strictly matching exact prefixes
                $keysToDelete = \App\Models\Setting::where('key', 'like', "slide{$slideId}_%")->get();
                foreach ($keysToDelete as $setting) {
                    if (str_starts_with($setting->key, "slide{$slideId}_")) {
                        if (str_ends_with($setting->key, '_image') && $setting->value) {
                            \Illuminate\Support\Facades\Storage::disk('public')->delete($setting->value);
                        }
                        $setting->delete();
                    }
                }
            }
        }
        unset($data['deleted_slides']);

        // 2. Handle Category Deletions (Surgical precision fix for Zombie Categories)
        if (!empty($data['deleted_categories'])) {
            $deletedCats = explode(',', $data['deleted_categories']);
            foreach ($deletedCats as $catId) {
                $catId = trim($catId);
                if (empty($catId)) continue;
                
                // Fetch broadly, but delete strictly matching exact prefixes
                $keysToDelete = \App\Models\Setting::where('key', 'like', "cat{$catId}_%")->get();
                foreach ($keysToDelete as $setting) {
                    if (str_starts_with($setting->key, "cat{$catId}_")) {
                        if (str_ends_with($setting->key, '_image') && $setting->value) {
                            \Illuminate\Support\Facades\Storage::disk('public')->delete($setting->value);
                        }
                        $setting->delete();
                    }
                }
            }
        }
        unset($data['deleted_categories']);

        // 3. Process Standard Updates & New Uploads
        foreach ($data as $key => $value) {
            // Handle valid file uploads
            if ($request->hasFile($key)) {
                $oldSetting = \App\Models\Setting::where('key', $key)->first();
                if ($oldSetting && $oldSetting->value) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($oldSetting->value);
                }
                $path = $request->file($key)->store('homepage', 'public');
                \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $path]);
            } 
            // Handle Text Inputs
            else {
                // FIX: If the input is meant for an image, but it's empty, SKIP IT.
                // This stops Category Images and Brand Banners from wiping out!
                if (str_ends_with($key, '_image')) {
                    continue;
                }

                \App\Models\Setting::updateOrCreate(
                    ['key' => $key], 
                    ['value' => $value ?? ''] 
                );
            }
        }

        return back()->with('success', 'Homepage settings updated successfully!');
    }
}