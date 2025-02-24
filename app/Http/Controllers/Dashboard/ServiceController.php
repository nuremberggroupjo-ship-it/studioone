<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use DataTables;
use Illuminate\Support\Facades\Storage;


class ServiceController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Service::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '
                        <a href="#" class="btn btn-sm btn-light edit-btn"
                            data-id="' . $row->id . '"
                        >Edit</a>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Dashboard.services.index');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'short_description' => 'required|string',
            'short_description_ar' => 'required|string',
            'description' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);
    
        $data = $request->except('image');
    
        $service = Service::find($request->id);
    
        if ($request->hasFile('image')) {
            if ($service && $service->image) {
                Storage::disk('public')->delete($service->image);
            }
    
            $data['image'] = $request->file('image')->store('services', 'public');
            copy(storage_path("app/public/{$data['image']}"), public_path("storage/{$data['image']}"));
        }
    
        Service::updateOrCreate(['id' => $request->id], $data);
    
        return response()->json(['success' => 'Service saved successfully.']);
    }
    

    public function destroy(Service $service) {
        if ($service->image) {
            \Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return response()->json(['success' => 'Service deleted successfully.']);
    }
    public function show($id)
    {
        $service = Service::findOrFail($id);

        return response()->json([
            'success' => true,
            'service' => [
                'id' => $service->id,
                'name' => $service->name,
                'name_ar' => $service->name_ar,
                'short_description' => $service->short_description,
                'short_description_ar' => $service->short_description_ar,
                'description' => $service->description,
                'description_ar' => $service->description_ar,
                'image' => $service->image ? asset('storage/' . $service->image) : null, // Full image URL
            ]
        ]);
    }

}