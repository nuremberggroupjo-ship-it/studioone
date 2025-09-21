@extends('landing.layouts.app')

@section('content')
    <!-- Start Banner  -->
    <section class="banner title-banner">
        <div class="container">
            <div class="title">
                <h1>{{ __('home.contact_title') }}</h1>
                <p>
                    {{ __('home.contact_description') }}
                </p>
            </div>
            <div class="path">
                <a href="{{ route('home') }}">{{ __('home.footer_link_1') }}</a>
                <span> <i class="fas fa-chevron-right"></i> <i class="fas fa-chevron-right"></i> </span>
                <a href="{{ route('contact') }}">{{ __('home.contact_title') }}</a>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Banner  -->
    <!-- Start Contact  -->
    <section class="contact">
        <div class="container">
            <div class="contact-option">
                <i class="fas fa-map-marker-alt"></i>
                <h3>{{ __('home.contact_address') }}</h3>
                <a href="https://maps.app.goo.gl/ZMo67XH5dDR7oCJM9"
                    target="_blank">{{ __('home.contact_address_description') }}</a>
            </div>
            <div class="contact-option">
                <i class="fas fa-at"></i>
                <h3>{{ __('home.contact_social_media') }}</h3>
                <a href="mailto:info@studioonejo.com">info@studioonejo.com</a>
                <div class="social">
                    <a href="https://www.facebook.com/share/1AAWd4Fysm/" target="_blank"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/studio.1.design/" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="contact-option">
                <i class="fas fa-phone"></i>
                <h3>{{ __('home.contact_phone') }}</h3>
                <a href="tel:00962799773512">00962799773512</a>
                <a href="tel:00962799742085">00962799742085</a>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <section class="contact-form">
        <div class="container">
            <div class="contact-form">
                <div class="image">
                    <img src="{{ asset('landing/img/Picture1.png') }}" alt="Contact Image">
                </div>

                <div class="form-container">
                    <div class="title">
                        <h4 class="subtitle">{{ __('home.get_in_touch') }}</h4>
                        <h2 class="title">{{ __('home.contact_title_form') }}</h2>
                    </div>
                    <form action="{{ route('contact.send') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" placeholder="{{ __('home.first_name') }}" name="first_name" required>
                            <input type="text" placeholder="{{ __('home.last_name') }}" name="last_name" required>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="{{ __('home.phone') }}" name="phone" required>
                            <input type="email" placeholder="{{ __('home.email') }}" name="email" required>
                        </div>
                        <textarea placeholder="{{ __('home.message') }}" name="message" required></textarea>
                        <button type="submit" class="submit-btn">
                            {{ __('home.send') }}
                            <span class="arrow-icon">➜</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <!-- End Contact  -->
@endsection


@push('scripts')
    @if(session('success'))
        <script>
            $(document).ready(function () {
                toastr.success("{{ session('success') }}");
            });
        </script>
    @endif
@endpush