<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EventsController extends Controller
{
        public function index()
    {
        $events = Events::all();
        return response()->json($events);
    }

    /**
     * Store a newly created events in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'locations' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
  
        $path = $request->file('image')->store('events', 'public');
        $validatedData['image'] = 'storage/' . $path;

        }

        $events = Events::create($validatedData);

        return response()->json([
            'message' => 'events created successfully',
            'data' => $events
        ], 201);
    }

    /**
     * Display the specified events.
     */
    public function show($id)
    {
        $event = events::find($id);
        
        if (!$event) {
            return response()->json([
                'message' => 'event not found'
            ], 404);
        }

        return response()->json($event);
    }

    /**
     * Update the specified events in storage.
     */
public function update(Request $request, $id)
{
    $event = Events::find($id);
    
    if (!$event) {
        return response()->json([
            'message' => 'Event not found'
        ], 404);
    }

    $validatedData = $request->validate([
        'title' => 'sometimes|string|max:255',
        'description' => 'sometimes|string',
        'locations' => 'sometimes|string',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle image update only if new image is provided
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($event->image) {
            $oldImage = str_replace('storage/', 'public/', $event->image);
            Storage::delete($oldImage);
        }
        
        $path = $request->file('image')->store('events', 'public');
        $validatedData['image'] = 'storage/' . $path;
    
    } else {
        // Keep the existing image if no new image is uploaded
        unset($validatedData['image']);
    }

    $event->update($validatedData);

    return response()->json([
        'message' => 'Event updated successfully',
        'data' => $event
    ]);
}

    /**
     * Remove the specified events from storage.
     */
    public function destroy($id)
    {
        $events = Events::find($id);
        
        if (!$events) {
            return response()->json([
                'message' => 'events not found'
            ], 404);
        }

        // Delete associated image
        if ($events->image) {
            Storage::delete($events->image);
        }

        $events->delete();

        return response()->json([
            'message' => 'events deleted successfully'
        ]);
    }
}
