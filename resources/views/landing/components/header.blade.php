    <!-- Start Header  -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('landing/img/WhiteLogo.png') }}" alt="Studio One Logo" />
                </a>
            </div>
            <div class="humburger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <nav>
                <ul>
                    <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">{{ __('home.home') }}</a></li>
                    <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ route('about') }}">{{ __('home.about') }}</a></li>
                    <li class="{{ request()->is('services') ? 'active' : '' }}"><a href="{{ route('services') }}" >{{ __('home.services') }}</a></li>
                    <li><a href="">{{ __('home.mission&vision') }}</a></li>
                    <li class="{{ request()->is('projects') ? 'active' : '' }}"><a href="{{ route('projects') }}">{{ __('home.projects') }}</a></li>
                    <li><a href="">{{ __('home.contact') }}</a></li>
                    <li><a href="{{ route('lang', ['locale' => App::getLocale() == 'ar' ? 'en' : 'ar']) }}" class="languageLink">{{ __('home.language') }}</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- End Header  -->