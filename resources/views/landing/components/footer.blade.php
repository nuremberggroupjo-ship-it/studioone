    <!-- Start Footer -->
    <footer>
        <div class="container">
            <div class="logo">
                <img src="{{ asset('landing/img/WhiteLogo.png') }}" alt="Studio One" />
                <p>{{ __('home.footer_description') }}</p>
                <a href="{{ url('contact') }}" class="mainLink">
                    {{ __('home.footer_link') }} <i class="fas fa-arrow-up"></i>
                </a>
            </div>
            <div class="links">
                <h2>{{ __('home.footer_title_1') }}</h2>
                <ul>
                    <li><i class="fas fa-chevron-right"></i><a href="{{ url('/') }}">{{ __('home.footer_link_1') }}</a></li>
                    <li><i class="fas fa-chevron-right"></i><a href="{{ url('about') }}">{{ __('home.footer_link_2') }}</a></li>
                    <li><i class="fas fa-chevron-right"></i><a href="{{ url('projects') }}">{{ __('home.footer_link_3') }}</a></li>
                    <li><i class="fas fa-chevron-right"></i><a href="{{ url('contact') }}">{{ __('home.footer_link_4') }}</a></li>
                    <li><i class="fas fa-chevron-right"></i><a href="{{ url('services') }}">{{ __('home.footer_link_5') }}</a></li>
                    <li><i class="fas fa-chevron-right"></i><a href="{{ url('mission-vision') }}">{{ __('home.footer_link_6') }}</a></li>
                </ul>
            </div>
            <div class="links">
                <h2>{{ __('home.footer_title_2') }}</h2>
                <ul>
                    <li>
                        <i class="far fa-envelope"></i><a href="mailto:{{ __('home.footer_email') }}" 
                                                          title="Send us an email"
                                                          aria-label="Send email to {{ __('home.footer_email') }}">
                                                            {{ __('home.footer_email') }}
                                                        </a>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i> <a href="tel:{{ __('home.footer_phone_1') }}" 
                                                            title="Call us"
                                                            aria-label="Call {{ __('home.footer_phone_1') }}">
                                                              {{ __('home.footer_phone_1') }}
                                                         </a>
                    </li>
                      <li>
                         <i class="fas fa-phone-alt"></i><a href="tel:{{ __('home.footer_phone_2') }}" 
                               title="Call us (Mobile)"
                               aria-label="Call {{ __('home.footer_phone_2') }}">
                                {{ __('home.footer_phone_2') }}
                            </a>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>   <a href="https://maps.google.com/?q={{ urlencode(__('home.footer_address')) }}" 
           target="_blank" 
           rel="noopener noreferrer"
           title="View on Google Maps"
           aria-label="View {{ __('home.footer_address') }} on Google Maps">{{ __('home.footer_address') }}</a>
                    </li>
                </ul>
                <div class="social">
                    <a href="https://www.facebook.com/share/1AAWd4Fysm/" target="_blank"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/studio.1.design?igsh=eHdiNTdtdXlvZ2dk" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="copyright">
                    <a href="https://nurembergtech.com" target="_blank">
                        <p>© {{ __('home.footer_copyright') }}</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </footer>
    <!-- End footer -->
