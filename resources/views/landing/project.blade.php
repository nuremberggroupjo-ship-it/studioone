@extends('landing.layouts.app')

@section('content')

    <!-- Start Banner  -->
    <section class="banner title-banner">
        <div class="container">
            <div class="title">
                <h1>{{ App::getLocale() === 'ar'? $project->title_ar : $project->title }}</h1>
            </div>
            <div class="path">
                <a href="{{ route('home') }}">{{ __('home.home') }}</a>
                <span> <i class="fas fa-chevron-right"></i> <i class="fas fa-chevron-right"></i> </span>
                <a href="{{ route('projects') }}">{{ __('home.projects_title_page') }}</a>
                <span> <i class="fas fa-chevron-right"></i> <i class="fas fa-chevron-right"></i> </span>
                <a href="{{ route('project', $project->id) }}">{{ App::getLocale() === 'ar'? $project->title_ar : $project->title }}</a>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Banner  -->

    <!-- Start Project  -->
    <section class="project">
        <div class="container">
            <div class="project-container">
                <div class="project-image">
                    <img src="{{ asset('storage/' . $project->primary_image->image_path) }}" alt="{{ App::getLocale() === 'ar' ? $project->title_ar : $project->title }}">
                </div>
                <div class="project-content">
                    <h2>{{ App::getLocale() === 'ar' ? $project->title_ar : $project->title }}</h2>
                    <p>{!! App::getLocale() === 'ar' ? $project->description_ar : $project->description !!}</p>
                </div>
            </div>
            <div class="project-categories">
                <div>
                    <h3>{{ __('home.categories') }}</h3>
                    @foreach ($categories as $category)
                        <span class="category">{{ App::getLocale() === 'ar' ? $category->name_ar : $category->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
@endsection
