@extends('landing.layouts.app')

@section('content')
    <!-- Start Banner  -->
    <section class="banner title-banner">
        <div class="container">
            <div class="title">
                <h1>{{ __('home.mission_vision_title') }}</h1>
                <p>
                    {{ __('home.mission_vision_description') }}
                </p>
            </div>
            <div class="path">
                <a href="{{ route('home') }}">{{ __('home.footer_link_1') }}</a>
                <span> <i class="fas fa-chevron-right"></i> <i class="fas fa-chevron-right"></i> </span>
                <a href="{{ route('mission-vision') }}">{{ __('home.mission_vision_title_page') }}</a>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Banner  -->
    <!-- Start About Us -->
    <section class="page-section mission-vision-section">
        <div class="container">
            <div class="image" style="background-image: url('{{ asset('storage/' . $ourMission[0]->image_path) }}')"></div>
            <div class="content">
                <div class="top-content">
                    <p>{{ App::getLocale() === 'ar' ? $ourMission[0]->small_header_ar : $ourMission[0]->small_header }}</p>
                </div>
                <div class="bottom-content">
                    <p>
                        {{ strip_tags(App::getLocale() === 'ar' ? $ourMission[0]->description_ar : $ourMission[0]->description) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="content">
                <div class="top-content">
                    <p>{{ App::getLocale() === 'ar' ? $ourVision[0]->small_header_ar : $ourVision[0]->small_header }}</p>
                </div>
                <div class="bottom-content">
                    <p>
                        {{ strip_tags(App::getLocale() === 'ar' ? $ourVision[0]->description_ar : $ourVision[0]->description) }}
                    </p>
                </div>
            </div>
            <div class="image" style="background-image: url('{{ asset('storage/' . $ourVision[0]->image_path) }}')"></div>

        </div>
        <div class="overlay"></div>
    </section>
    <!-- End About Us -->
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
