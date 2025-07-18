<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProjectsController extends Controller
{
public function index()
{
    $projects = Projects::orderBy('created_at', 'desc')->get();

    return response()->json([
        'status' => 'success',
        'data' => $projects
    ]);
}

    /**
     * Store a newly created projects in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'color' => 'required|string',
            'links' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
       $path = $request->file('image')->store('projects', 'public');
        $validatedData['image'] = 'storage/' . $path;
        }

        $projects = Projects::create($validatedData);

        return response()->json([
            'message' => 'Projects created successfully',
            'data' => $projects
        ], 201);
    }

    /**
     * Display the specified projects.
     */
    public function show($id)
    {
        $project = Projects::find($id);
        
        if (!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        return response()->json($project);
    }

    /**
     * Update the specified projects in storage.
     */
    public function update(Request $request, $id)
    {
        $projects = Projects::find($id);
        
        if (!$projects) {
            return response()->json([
                'message' => 'Projects not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'color' => 'sometimes|string',
            'links' => 'sometimes|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($projects->image) {
                Storage::delete($projects->image);
            }
            
          $path = $request->file('image')->store('projects', 'public');
        $validatedData['image'] = 'storage/' . $path;
        }

        $projects->update($validatedData);

        return response()->json([
            'message' => 'projects updated successfully',
            'data' => $projects
        ]);
    }

    /**
     * Remove the specified projects from storage.
     */
    public function destroy($id)
    {
        $projects = Projects::find($id);
        
        if (!$projects) {
            return response()->json([
                'message' => 'projects not found'
            ], 404);
        }

        // Delete associated image
        if ($projects->image) {
            Storage::delete($projects->image);
        }

        $projects->delete();

        return response()->json([
            'message' => 'projects deleted successfully'
        ]);
    }
}
