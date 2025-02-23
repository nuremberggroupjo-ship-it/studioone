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
    <!-- Start Customer -->
    <section class="customer-section">
        <div class="container">
            <div class="main-title">
                <h2>{{ __('home.customer_title') }}</h2>
                <p>{{ __('home.customer_description') }}</p>
            </div>
            <div class="swiper-container customer-logos-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture2.jpg') }}" alt="Customer Logo 2">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture3.jpg') }}" alt="Customer Logo 3">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture4.jpg') }}" alt="Customer Logo 4">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture5.png') }}" alt="Customer Logo 5">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture6.jpg') }}" alt="Customer Logo 6">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture7.png') }}" alt="Customer Logo 7">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture8.jpg') }}" alt="Customer Logo 8">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture9.jpg') }}" alt="Customer Logo 9">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture10.jpg') }}" alt="Customer Logo 10">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture11.jpg') }}" alt="Customer Logo 11">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture12.png') }}" alt="Customer Logo 12">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture13.png') }}" alt="Customer Logo 13">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture14.jpg') }}" alt="Customer Logo 14">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture15.jpg') }}" alt="Customer Logo 15">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture16.png') }}" alt="Customer Logo 16">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture17.png') }}" alt="Customer Logo 17">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture18.png') }}" alt="Customer Logo 18">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('landing/img/Picture19.png') }}" alt="Customer Logo 19">
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Customer -->
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
