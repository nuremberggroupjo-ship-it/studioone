@extends('landing.layouts.app')

@section('content')

    <!-- Start Banner  -->
    <section class="banner title-banner">
        <div class="container">
            <div class="title">
                <h1>{{ App::getLocale() === 'ar' ? $service->name_ar : $service->name }}</h1>
            </div>
            <div class="path">
                <a href="{{ route('home') }}">{{ __('home.home') }}</a>
                <span> <i class="fas fa-chevron-right"></i> <i class="fas fa-chevron-right"></i> </span>
                <a href="{{ route('services') }}">{{ __('home.services_title_page') }}</a>
                <span> <i class="fas fa-chevron-right"></i> <i class="fas fa-chevron-right"></i> </span>
                <a href="{{ route('service', $service->id) }}">{{ App::getLocale() === 'ar' ? $service->name_ar : $service->name }}</a>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Banner  -->

    <!-- Start Service  -->
    <section class="service">
        <div class="container">
            <div class="service-container">
                <div class="service-image">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                </div>
                <div class="service-content">
                {!! App::getLocale() === 'ar' ? $service->description_ar : $service->description !!}
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
@endsection
