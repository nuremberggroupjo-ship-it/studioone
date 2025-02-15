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
            <span class="category">All</span>
            <span class="category">Design</span>
            <span class="category">3D Renders</span>
            <span class="category">Materials</span>
            <span class="category">Execution</span>
            <span class="category">Renovation</span>
        </div>
        <div class="container portfolio-grid">
            <div class="portfolio-item design">
                <img src="{{asset('landing/img/about-us-image-1.jpg')}}" alt="Project 1">
            </div>
            <div class="portfolio-item 3d-renders">
                <img src="{{asset('landing/img/about-us-image-1.jpg')}}" alt="Project 2">
            </div>
            <div class="portfolio-item materials">
                <img src="{{asset('landing/img/about-us-image-1.jpg')}}" alt="Project 3">
            </div>
            <div class="portfolio-item execution">
                <img src="{{asset('landing/img/about-us-image-1.jpg')}}" alt="Project 4">
            </div>
            <div class="portfolio-item renovation">
                <img src="{{asset('landing/img/about-us-image-1.jpg')}}" alt="Project 5">
            </div>
            <div class="portfolio-item design">
                <img src="{{asset('landing/img/about-us-image-1.jpg')}}" alt="Project 6">
            </div>
            <div class="portfolio-item 3d-renders">
                <img src="{{asset('landing/img/about-us-image-1.jpg')}}" alt="Project 7">
            </div>
            <div class="portfolio-item materials">
                <img src="{{asset('landing/img/about-us-image-1.jpg')}}" alt="Project 8">
            </div>
            <div class="portfolio-item execution">
                <img src="{{asset('landing/img/about-us-image-1.jpg')}}" alt="Project 9">
            </div>
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
                    <a href="#">{{ __('home.contact_us_link') }} <i class="fas fa-arrow-up"></i></a>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Contact Us -->
@endsection
