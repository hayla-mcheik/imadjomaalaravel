<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SettingController extends Controller
{
            public function index()
    {
        $settings = Settings::first();     
        if (!$settings) {
            return response()->json([
                'message' => 'settings information not found'
            ], 404);
        }
        return response()->json([
'settings' => $settings
        ]);
    }


    /**
     * Update the settings information.
     */
    public function update(Request $request)
    {
        $settings = settings::firstOrNew();
        
        $validatedData = $request->validate([
            'fb' => 'sometimes|string|max:255',
            'insta' => 'sometimes|string|max:500',
            'linkedin' => 'sometimes|string',
            'call' => 'sometimes|string',
            'twitter' => 'sometimes|string',
            'tiktok' => 'sometimes|string',
            'youtube' => 'sometimes|string',
            'snapchat' => 'sometimes|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($settings->logo) {
                Storage::delete($settings->logo);
            }
                    $path = $request->file('logo')->store('hero', 'public');
              $validatedData['image'] = 'storage/' . $path;
        }

        $settings->fill($validatedData);
        $settings->save();

        return response()->json([
            'message' => 'settings information updated successfully',
            'data' => $settings
        ]);
    }
}
