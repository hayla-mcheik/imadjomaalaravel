<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class HeroSliderController extends Controller
{
        public function index()
    {
        $heroslider = HeroSlider::first();     
        if (!$heroslider) {
            return response()->json([
                'message' => 'heroslider information not found'
            ], 404);
        }
        return response()->json($heroslider);
    }


    /**
     * Update the heroslider information.
     */
    public function update(Request $request)
    {
        $heroslider = HeroSlider::firstOrNew();
        
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'smalldesc' => 'sometimes|string|max:500',
            'description' => 'sometimes|string',
            'mission' => 'sometimes|string',
            'vision' => 'sometimes|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($heroslider->image) {
                Storage::delete($heroslider->image);
            }
                    $path = $request->file('image')->store('hero', 'public');
              $validatedData['image'] = 'storage/' . $path;
        }

        $heroslider->fill($validatedData);
        $heroslider->save();

        return response()->json([
            'message' => 'heroslider information updated successfully',
            'data' => $heroslider
        ]);
    }

}
