<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $language = app()->getLocale();
        $sliders = Slider::with(['translations' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->get();

        return view('landing.index', compact('sliders'));
    }
    public function getSliders(Request $request)
    {
        $sliders = Slider::with('translations')->get();

        return response()->json([
            'data' => $sliders
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider = new Slider();
        $slider->image = $validatedData['image'];
        $slider->save();

        foreach ($validatedData['title'] as $language => $title) {
            $slider->translations()->create([
                'language' => $language,
                'title' => $title,
                'description' => $validatedData['description'][$language],
            ]);
        }

        return response()->json([
            'message' => 'Slider created successfully'
        ]);
    }
}
