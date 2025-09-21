@extends('landing.layouts.app')

@section('content')
    <!-- Start Banner  -->
    <section class="banner title-banner">
        <div class="container">
            <div class="title">
                <h1>{{ __('home.about_us_title') }}</h1>
                <p>
                    {{ __('home.about_us_description') }}
                </p>
            </div>
            <div class="path">
                <a href="{{ route('home') }}">{{ __('home.footer_link_1') }}</a>
                <span> <i class="fas fa-chevron-right"></i> <i class="fas fa-chevron-right"></i> </span>
                <a href="{{ route('about') }}">{{ __('home.about_us_title_page') }}</a>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Banner  -->
    <!-- Start About Us -->
    <section class="aboutUs page-section">
        <div class="container">
            <div class="image" style="background-image: url('{{ asset('storage/app/public/' . $posts[0]->image_path) }}')"></div>
            <div class="content">
                <div class="top-content">
                    <h3>{{ App::getLocale() === 'ar' ? $posts[0]->name_ar : $posts[0]->name }}</h3>
                    <p>{{ App::getLocale() === 'ar' ? $posts[0]->small_header_ar : $posts[0]->small_header }}</p>
                </div>
                <div class="bottom-content">
                    <p>
                        <span class="description-text">
                            {{ strip_tags(App::getLocale() === 'ar' ? $posts[0]->description_ar : $posts[0]->description) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End About Us -->
    <!-- Start Customer -->
    <section class="customer-section">
        <div class="container">
            <div class="main-title">
                <h2>{{ __('home.customer_title') }}</h2>
                <p>{{ __('home.customer_description') }}</p>
            </div>
            <div class="swiper-container customer-logos-slider">
                <div class="swiper-wrapper">
                @foreach ($customers as $customer)
                    <div class="swiper-slide">
                        <img src="{{ asset('images/' . $customer->image) }}" alt="{{ App::getLocale() === 'ar' ? $customer->name_ar : $customer->name }}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Customer -->
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
