<?php


namespace App\Http\Controllers\Dashboard;

use App\Models\Slider;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::latest()->get();
            return DataTables::of($data)

                ->addColumn('action', function ($row) {
                    return ' <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary edit-btn"
                                data-id="' . $row->id . '"
                                data-title="' . e($row->title) . '"
                                data-title_ar="' . e($row->title_ar) . '"
                                data-description="' . e($row->description) . '"
                                data-description_ar="' . e($row->description_ar) . '"
                                data-button_name="' . e($row->button_name) . '"
                                data-button_name_ar="' . e($row->button_name_ar) . '"
                                data-button_link="' . e($row->button_link) . '"
                                data-image="' . e($row->image) . '">
                                Edit
                            </a>
                            <button class="btn btn-sm btn-danger delete-slider" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns([ 'action'])
                ->make(true);
        }

        return view('Dashboard.sliders.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description' => 'required|string',
            'description_ar' => 'required|string',
            'button_name' => 'required|string|max:255',
            'button_name_ar' => 'required|string|max:255',
            'button_link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {

            $data['image'] = $request->file(key: 'image')->store('sliders', 'public');
            copy(storage_path("app/public/{$data['image']}"), public_path("storage/{$data['image']}"));

        }

        Slider::updateOrCreate(['id' => $request->id], $data);

        return response()->json(['success' => 'Slider saved successfully!']);
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->image) {
            Storage::delete('public/' . $slider->image);
        }
        $slider->delete();

        return response()->json(['success' => 'Slider deleted successfully!']);
    }
}
