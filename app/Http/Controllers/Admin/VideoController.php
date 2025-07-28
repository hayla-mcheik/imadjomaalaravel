<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::first();     
        if (!$video) {
            return response()->json([
                'message' => 'Video information not found'
            ], 404);
        }
        return response()->json([
            'video' => $video
        ]);
    }

    public function update(Request $request)
    {
        $video = Video::firstOrNew();
        
        $validatedData = $request->validate([
            'video' => 'sometimes|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-flv,video/webm|max:50000', // ~50MB
        ]);

        if ($request->hasFile('video')) {
            // Delete old video if exists
            if ($video->video) {
                Storage::disk('public')->delete(str_replace('storage/', '', $video->video));
            }
            
            $path = $request->file('video')->store('videos', 'public');
            $validatedData['video'] = 'storage/' . $path;
        }

        $video->fill($validatedData);
        $video->save();

        return response()->json([
            'message' => 'Video updated successfully',
            'data' => $video
        ]);
    }
}