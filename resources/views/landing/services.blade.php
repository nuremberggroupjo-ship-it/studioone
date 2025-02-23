@extends('landing.layouts.app')

@section('content')
    <!-- Start Banner  -->
    <section class="banner title-banner">
        <div class="container">
            <div class="title">
                <h1>{{ __('home.services_title_page') }}</h1>
                <p>
                    {{ __('home.services_description_page') }}
                </p>
            </div>
            <div class="path">
                <a href="{{ route('home') }}">{{ __('home.footer_link_1') }}</a>
                <span> <i class="fas fa-chevron-right"></i> <i class="fas fa-chevron-right"></i> </span>
                <a href="{{ route('services') }}">{{ __('home.services') }}</a>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- Start WhatWeDo -->
    <section class="whatWeDo">
        <div class="container">
            <div class="main-title">
                <h2>{{ __('home.services') }}</h2>
                <p>{{ __('home.services_description') }}</p>
            </div>
            <div class="services">
                @foreach ($services as $service)
                <div class="service">
                    <div class="image" style="background-image: url('{{ asset('storage/' . $service->image) }}')"></div>
                    <div class="content">
                        <h3>{{ App::getLocale() == 'ar' ? $service->name_ar : $service->name }}</h3>
                        <p>
                            {{ App::getLocale() == 'ar' ? $service->short_description_ar : $service->short_description }}
                        </p>
                        <a href="{{ route('service' , $service->id) }}">{{ __('home.services_link_1') }} <i class="fas fa-chevron-right"></i></a>
                        <i class="fas fa-tools icon"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End WhatWeDo -->
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
