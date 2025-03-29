@extends('landing.layouts.app')

@section('content')

    <!-- Start Banner  -->
    <section class="banner title-banner">
        <div class="container">
            <div class="title">
                <h1>{{ __('home.projects_title') }}</h1>
                <p>
                    {{ __('home.projects_description') }}
                </p>
            </div>
            <div class="path">
                <a href="{{ route('home') }}">{{ __('home.footer_link_1') }}</a>
                <span> <i class="fas fa-chevron-right"></i> <i class="fas fa-chevron-right"></i> </span>
                <a href="{{ route('projects') }}">{{ __('home.projects_title_page') }}</a>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Banner  -->
    <!--Start Projects--> 
    <section class="portfolio">
        <div class="main-title">
            <h2>{{ __('home.projects_title_page') }}</h2>
            <p>{{ __('home.projects_description_page') }}</p>
        </div>
        <div class="categories">
            <span class="category">{{ App::getLocale() === 'ar' ? 'الكل' : 'All' }}</span>
            @foreach ($categories as $category)
                <span class="category">{{ App::getLocale() === 'ar' ? $category->name_ar : $category->name }}</span>
            @endforeach
        </div>
        <div class="portfolio-grid">
            @foreach ($projects as $project)
            <div class="portfolio-item {{implode(' ', $project->categories->pluck(App::getLocale() === 'ar' ? 'name_ar' : 'name')->toArray())}}">
                <a href="{{ route('project', $project->id) }}" class="overlay-link">
                    <img src="{{asset('storage/'.$project->primary_image->image_path)}}" alt="{{ App::getLocale() === 'ar' ? $project->title_ar : $project->title }}">
                    <div class="overlay-text">{{ __('home.read_more') }}</div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="overlay"></div>
    </section>
    <!--End Projects--> 
    <!-- Start Contact Us -->
    <section class="contactUs">
        <div class="contact-container">
            <div class="main-title">
                <h2>{{ __('home.contact_us_title') }}</h2>
                <p>{{ __('home.contact_us_description') }}</p>
                <div class="mainLink">
                    <a href="{{ route('contact') }}">{{ __('home.contact_us_link') }} <i class="fas fa-arrow-up"></i></a>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Contact Us -->
@endsection
