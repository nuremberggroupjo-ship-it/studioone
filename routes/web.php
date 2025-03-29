<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Models\Slider;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\Dashboard\SliderController as DashboardSliderController;
use App\Http\Controllers\Dashboard\ServiceController as DashboardServiceController;
use App\Http\Controllers\Dashboard\ProjectController as DashboardProjectController;
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\Dashboard\CustomersController as DashboardCustomerController;

use App\Http\Controllers\ContactController;
use App\Models\Service;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Post;
use App\Models\Customers;
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin', 'as'=> "admin."], function () {
    Route::get('/', function () {
        return view("Dashboard.index");
    })->name('dashboard');

    Route::resource('sliders', DashboardSliderController::class);
    Route::resource('services', DashboardServiceController::class);
    Route::resource('projects', DashboardProjectController::class);
    Route::resource('posts', DashboardPostController::class);
    Route::resource('customers', DashboardCustomerController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('sliders', [SliderController::class, 'getSliders'])->name('sliders.index');
    Route::post('sliders', [SliderController::class, 'store'])->name('sliders.store');
});

// Landing
Route::get('/', function () {
    $sliders = Slider::all();
    $services = Service::all();
    $posts = Post::all();
    $projects = Project::with('primary_image')->where('is_recent', 1)->get(); 
    return view('landing.index', compact('sliders', 'services', 'posts', 'projects'));
})->name('home');
// about
Route::get('/about', function () {
    $posts = Post::where('slug', 'about')->get();
    $customers = Customers::all();
    return view('landing.about', compact('posts', 'customers'));
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
    $services = Service::all();
    return view('landing.services', compact('services'));
})->name('services');

// service
Route::get('/services/{id}', function ($id) {
    $service = Service::find($id);
    return view('landing.service', compact('service'));
})->name('service');

// projects
Route::get('/projects', function () {
    $projects = Project::all();
    $categories = ProjectCategory::all();
    return view('landing.projects', compact('projects', 'categories'));
})->name('projects');

// project
Route::get('/projects/{id}', function ($id) {
    $project = Project::find($id);
    $categories = ProjectCategory::whereIn('id', $project->categories->pluck('id'))->get();
    return view('landing.project', compact('project', 'categories'));
})->name('project');

// contact
Route::get('/contact', function () {
    return view('landing.contact');
})->name('contact');
Route::post('/send-contact', [ContactController::class, 'send'])->name('contact.send');
// mission&vision
Route::get('/mission-vision', function () {
    $ourMission = Post::where('slug', 'our-mission')->get();
    $ourVision = Post::where('slug', 'our-vision')->get();
    return view('landing.mission-vision.index', compact('ourMission', 'ourVision'));
})->name('mission-vision');

require __DIR__.'/auth.php';
