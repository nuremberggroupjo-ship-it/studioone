@extends('Dashboard.layouts.master')

@section('content')
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10">
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('login') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-8">
                            <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control bg-transparent" value="{{ old('email') }}" required autofocus />
                        </div>
                        <!--end::Input group-->
                        <div class="fv-row mb-3">
                            <input type="password" name="password" placeholder="Password" autocomplete="off" class="form-control bg-transparent" required />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <span class="indicator-label">Sign In</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Submit button-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
        </div>
        <!--end::Body-->
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(assets/media/misc/auth-bg.png)">
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <a href="index.html" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="{{ asset('assets/media/logos/WhiteLogo.png') }}" class="h-60px h-lg-75px" />
                </a>
            </div>
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>

@endsection
