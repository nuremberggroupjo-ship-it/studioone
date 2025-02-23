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
    <!-- Start Process -->
    <section class="process-section">
        <div class="container">
            <div class="main-title">
                <h2>{{ __('home.process_title') }}</h2>
                <p>{{ __('home.process_description') }}</p>
            </div>
            <div class="process">
                <div class="process-item">
                    <div class="icon">
                        <span>01</span><i class="fas fa-comments"></i>
                    </div>
                    <h3>{{ __('home.process_title_1') }}</h3>
                    <p>
                        {{ __('home.process_description_1') }}
                    </p>
                </div>
                <div class="process-item">
                    <div class="icon"><span>02</span><i class="fas fa-lightbulb"></i></div>
                    <h3>{{ __('home.process_title_2') }}</h3>
                    <p>
                        {{ __('home.process_description_2') }}
                    </p>
                </div>
                <div class="process-item">
                    <div class="icon">
                        <span>03</span><i class="fas fa-pencil-ruler"></i>
                    </div>
                    <h3>{{ __('home.process_title_3') }}</h3>
                    <p>
                        {{ __('home.process_description_3') }}
                    </p>
                </div>
                <div class="process-item">
                    <div class="icon">
                        <span>04</span><i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3>{{ __('home.process_title_4') }}</h3>
                    <p>
                        {{ __('home.process_description_4') }}
                    </p>
                </div>
                <div class="process-item">
                    <div class="icon">
                        <span>05</span><i class="fas fa-tools"></i>
                    </div>
                    <h3>{{ __('home.process_title_5') }}</h3>
                    <p>
                        {{ __('home.process_description_5') }}
                    </p>
                </div>
                <div class="process-item">
                    <div class="icon">
                        <span>06</span><i class="fas fa-check-double"></i>
                    </div>
                    <h3>{{ __('home.process_title_6') }}</h3>
                    <p>
                        {{ __('home.process_description_6') }}
                    </p>
                </div>
                <div class="process-item">
                    <div class="icon">
                        <span>07</span><i class="fas fa-headset"></i>
                    </div>
                    <h3>{{ __('home.process_title_7') }}</h3>
                    <p>
                        {{ __('home.process_description_7') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Process -->
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
