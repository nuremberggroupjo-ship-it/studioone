<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use DataTables;
use Validator;
class ProjectController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $projects = Project::with('categories', 'images','primary_image')->latest()->get();

        return DataTables::of($projects)
            ->addColumn('categories', function ($row) {
                return $row->categories->pluck('name')->join(', ');
            })
            ->addColumn('images', function ($row) {
                return $row->images->pluck('image_path')->join(', ');
            })
     
            ->addColumn('action', function ($row) {
                return '
                    <button class="btn btn-sm btn-primary edit-btn"
                        data-id="'.$row->id.'"
                        data-title="'.$row->title.'"
                        data-title_ar="'.$row->title_ar.'"
                        data-description="'.$row->description.'"
                        data-description_ar="'.$row->description_ar.'"
                        data-categories="'.implode(',', $row->categories->pluck('id')->toArray()).'"
                        data-is_recent="'.$row->is_recent.'"
                        data-primary_image="'.($row->primary_image ? $row->primary_image->image_path : '').'"
                        data-image="'.implode(',', $row->images->pluck('image_path')->toArray()).'">
                        Edit
                    </button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="'.$row->id.'">Delete</button>';
                
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }
    $categories = ProjectCategory::all(); 
    return view('Dashboard.projects.index', compact('categories'));
}

    
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'title_ar' => 'required|string|max:255',
        'description' => 'required|string',
        'description_ar' => 'required|string',
        'categories' => 'required|array',
        'image' => 'nullable|image', 
        'is_recent' => 'nullable|boolean',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Check if the project ID is provided (for update case)
    $project = $request->id ? Project::findOrFail($request->id) : new Project();

    // Update or create the project
    $project->title = $request->title;
    $project->title_ar = $request->title_ar;
    $project->description = $request->description;
    $project->description_ar = $request->description_ar;
    $project->is_recent = $request->is_recent ?? 0;
    $project->save();

    if ($request->hasFile('image')) {
        if ($project->primary_image) {
            Storage::delete('public/' . $project->primary_image->image_path);
            $project->primary_image->delete();
        }

        $imagePath = $request->file('image')->store('projects', 'public');
        ProjectImage::create([
            'project_id' => $project->id,
            'image_path' => $imagePath,
            'is_primary' => true, 
        ]);
    }

    $project->categories()->sync($request->categories);

    if ($request->hasFile(key: 'images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('projects', 'public');
            $a = ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => $imagePath,
                'is_primary' => false, 
            ]);

        }
        

    }

    return response()->json(['message' => $project->exists ? 'Project updated successfully!' : 'Project created successfully!', 'project' => $project]);
}




    public function destroy(Project $project)
    {
        foreach ($project->images as $image) {
            Storage::delete('public/' . $image->image_path);
        }
        $project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }

}