@extends('landing.layouts.app')

@section('content')
 <!-- Start Banner  -->
 <section class="banner">
    <div class="banner-container">
        <div class="social">
            <div class="line"></div>
            <div class="links">
                <a href="https://www.facebook.com/share/1AAWd4Fysm/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/studio.1.design?igsh=eHdiNTdtdXlvZ2dk" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="banner-swiper swiper">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="content">
                        <div class="text">
                            <h1>{{ App::getLocale() == 'ar' ? $slider->title_ar : $slider->title }}</h1>
                            <p>
                                {{ App::getLocale() == 'ar' ? $slider->description_ar : $slider->description }}
                            </p>
                            <a href="{{ $slider->button_link }}" class="mainLink">
                                {{ App::getLocale() == 'ar' ? $slider->button_name_ar : $slider->button_name }} <i class="fas fa-arrow-up"></i>
                            </a>
                        </div>
                        <div class="image"
                            style="background-image: url('{{ asset('storage/' . $slider->image) }}');">
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <!-- Swiper Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="overlay"></div>
</section>
<!-- End Banner  -->
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
                    <a href="{{ route('services') }}">{{ __('home.services_link_1') }} <i class="fas fa-chevron-right"></i></a>
                    <i class="fas fa-tools icon"></i>
                </div>
            </div>
            @endforeach
            {{-- <div class="service">
                <div class="image" style="background-image: url('{{ asset('landing/img/4.jpg') }}')"></div>
                <div class="content">
                    <h3>{{ __('home.services_title_2') }}</h3>
                    <p>
                        {{ __('home.services_description_2') }}
                    </p>
                    <a href="#">{{ __('home.services_link_2') }} <i class="fas fa-chevron-right"></i></a>
                    <i class="fas fa-tools icon"></i>
                </div>
            </div>
            <div class="service">
                <div class="image" style="background-image: url('{{ asset('landing/img/5.jpg') }}')"></div>
                <div class="content">
                    <h3>{{ __('home.services_title_3') }}</h3>
                    <p>
                        {{ __('home.services_description_3') }}
                    </p>
                    <a href="#">{{ __('home.services_link_3') }} <i class="fas fa-chevron-right"></i></a>
                    <i class="fas fa-tools icon"></i>
                </div>
            </div>
            <div class="service">
                <div class="image" style="background-image: url('{{ asset('landing/img/6.jpg') }}')"></div>
                <div class="content">
                    <h3>{{ __('home.services_title_4') }}</h3>
                    <p>
                        {{ __('home.services_description_4') }}
                    </p>
                    <a href="#">{{ __('home.services_link_4') }} <i class="fas fa-chevron-right"></i></a>
                    <i class="fas fa-tools icon"></i>
                </div>
            </div>
            <div class="service">
                <div class="image" style="background-image: url('{{ asset('landing/img/7.jpg') }}')"></div>
                <div class="content">
                    <h3>{{ __('home.services_title_5') }}</h3>
                    <p>
                        {{ __('home.services_description_5') }}
                    </p>
                    <a href="#">{{ __('home.services_link_5') }} <i class="fas fa-chevron-right"></i></a>
                    <i class="fas fa-tools icon"></i>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="overlay"></div>
</section>
<!-- End WhatWeDo -->
<!-- Start About Us -->
<section class="aboutUs">
    <div class="container">
        <div class="image" style="background-image: url('{{ asset('landing/img/about-us-image-1.jpg') }}')"></div>
        <div class="content">
            <div class="top-content">
                <h3>{{ __('home.about_us_title') }}</h3>
                <p>{{ __('home.about_us_description') }}</p>
            </div>
            <div class="bottom-content">
                <p>{{ __('home.about_us_description_2') }}</p>
                <p>
                    {{ __('home.about_us_description_3') }}
                </p>
            </div>
            <a href="#" class="mainLink">
                {{ __('home.about_us_link') }} <i class="fas fa-arrow-up"></i>
            </a>
        </div>
        <div class="image" style="background-image: url('{{ asset('landing/img/9.jpg') }}')"></div>
    </div>
    <div class="overlay"></div>
</section>
<!-- End About Us -->
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
<!-- Start Mission Vision -->
<section class="mission-vision">
    <div class="container">
        <div class="mission">
            <div class="image" style="background-image: url('{{ asset('landing/img/10.jpg') }}')"></div>
            <div class="content">
                <h3>{{ __('home.mission_vision_title_1') }}</h3>
                <p>
                    {{ __('home.mission_vision_description_1') }}
                </p>
            </div>
        </div>
        <div class="vision">
            <div class="content">
                <h3>{{ __('home.mission_vision_title_2') }}</h3>
                <p>
                    {{ __('home.mission_vision_description_2') }}
                </p>
            </div>
            <div class="image" style="background-image: url('{{ asset('landing/img/11.jpg') }}')"></div>
        </div>
    </div>
    <div class="overlay"></div>
</section>
<!-- End Mission Vision -->
<!-- Start Projects -->
<section class="projects">
    <div class="container">
        <div class="main-title">
            <h2>{{ __('home.projects_title') }}</h2>
            <p>{{ __('home.projects_description') }}</p>
        </div>
    </div>
    <div class="swiper projects-swiper">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="image">
                    <img src="{{ asset('landing/img/portfolio1.jpg') }}" alt="Project Image" />
                    <div class="circle-text">
                        <h3>{{ __('home.projects_title_1') }}</h3>
                        <p>
                            {{ __('home.projects_description_1') }}
                        </p>
                        <div class="mainLink">
                            <a href="#"><i class="fas fa-arrow-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="image">
                    <img src="{{ asset('landing/img/portfolio2.jpg') }}" alt="Project Image" />
                    <div class="circle-text">
                        <h3>{{ __('home.projects_title_2') }}</h3>
                        <p>
                            {{ __('home.projects_description_2') }}
                        </p>
                        <div class="mainLink">
                            <a href="#"><i class="fas fa-arrow-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide">
                <div class="image">
                    <img src="{{ asset('landing/img/portfolio3.jpg') }}" alt="Project Image" />
                    <div class="circle-text">
                        <h3>{{ __('home.projects_title_3') }}</h3>
                        <p>
                            {{ __('home.projects_description_3') }}
                        </p>
                        <div class="mainLink">
                            <a href="#"><i class="fas fa-arrow-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Swiper Pagination -->
        <div class="swiper-pagination"></div>
    </div>
    <div class="overlay"></div>
</section>

<!-- End Projects -->
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
