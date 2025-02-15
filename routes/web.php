<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Models\Slider;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\Dashboard\SliderController as DashboardSliderController;
use App\Http\Controllers\Dashboard\ServiceController as DashboardServiceController;

// Dashboard

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin', 'as'=> "admin."], function () {
    Route::get('/', function () {
        return view("Dashboard.index");
    })->name('dashboard');

    Route::resource('sliders', DashboardSliderController::class);
    Route::resource('services', DashboardServiceController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('sliders', [SliderController::class, 'getSliders'])->name('sliders.index');
    Route::post('sliders', [SliderController::class, 'store'])->name('sliders.store');
});

// Landing
Route::get('/', function () {
    $sliders = Slider::all();
    return view('landing.index', compact('sliders'));
})->name('home');
// about
Route::get('/about', function () {
    return view('landing.about');
})->name('about');

// Change Language
Route::get('/lang/{locale}', function (string $locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(404);
    }
    Session::put('locale', $locale);
    return redirect()->back();
})->name('lang');

// services
Route::get('/services', function () {
    return view('landing.services');
})->name('services');

// projects
Route::get('/projects', function () {
    return view('landing.projects');
})->name('projects');

require __DIR__.'/auth.php';
