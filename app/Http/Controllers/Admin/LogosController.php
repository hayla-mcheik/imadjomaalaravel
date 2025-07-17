<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class LogosController extends Controller
{
            public function index()
    {
        $logos = Logos::all();
        return response()->json($logos);
    }

    /**
     * Store a newly created logos in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
              $path = $request->file('image')->store('logos', 'public');
        $validatedData['image'] = 'storage/' . $path;    
        }

        $logos = Logos::create($validatedData);

        return response()->json([
            'message' => 'logos created successfully',
            'data' => $logos
        ], 201);
    }

    /**
     * Display the specified logos.
     */
    public function show($id)
    {
        $location = Logos::find($id);
        
        if (!$location) {
            return response()->json([
                'message' => 'logos not found'
            ], 404);
        }

        return response()->json($location);
    }

    /**
     * Update the specified logos in storage.
     */
    public function update(Request $request, $id)
    {
        $logos = Logos::find($id);
        
        if (!$logos) {
            return response()->json([
                'message' => 'logos not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($logos->image) {
                Storage::delete($logos->image);
            }
            
           $path = $request->file('image')->store('logos', 'public');
        $validatedData['image'] = 'storage/' . $path;
        }

        $logos->update($validatedData);

        return response()->json([
            'message' => 'logos updated successfully',
            'data' => $logos
        ]);
    }

    /**
     * Remove the specified logos from storage.
     */
    public function destroy($id)
    {
        $logos = Logos::find($id);
        
        if (!$logos) {
            return response()->json([
                'message' => 'logos not found'
            ], 404);
        }

        // Delete associated image
        if ($logos->image) {
            Storage::delete($logos->image);
        }

        $logos->delete();

        return response()->json([
            'message' => 'logos deleted successfully'
        ]);
    }
}
