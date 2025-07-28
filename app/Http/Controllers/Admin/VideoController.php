<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

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
            'video' => 'required|url|starts_with:https://www.youtube.com/watch,https://youtu.be/',
        ]);

        // Extract YouTube video ID from URL
        $videoId = $this->extractYoutubeId($validatedData['video']);
        
        if (!$videoId) {
            return response()->json([
                'message' => 'Invalid YouTube URL'
            ], 422);
        }

        $video->video = $videoId;
        $video->save();

        return response()->json([
            'message' => 'YouTube video updated successfully',
            'data' => $video
        ]);
    }

    private function extractYoutubeId($url)
    {
        // Handle various YouTube URL formats
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
        preg_match($pattern, $url, $matches);
        return $matches[1] ?? null;
    }
}