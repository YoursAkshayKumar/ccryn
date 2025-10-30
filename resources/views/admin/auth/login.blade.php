@extends('admin.partials.layouts.master-auth')

@section('title', 'Sign In | Central Council for Research in Yoga & Naturopathy (CCRYN)')

@section('css')
    @include('admin.partials.head-css', ['auth' => 'layout-auth'])
@endsection

@section('content')

    <!-- START -->
    <div class="account-pages">
        <img src="{{ asset('assets/images/auth/auth_bg.jpeg') }}" alt="auth_bg" class="auth-bg light">
        <img src="{{ asset('assets/images/auth/auth_bg_dark.jpg') }}" alt="auth_bg_dark" class="auth-bg dark">
        <div class="container">
            <div class="justify-content-center row gy-0">

                <div class="col-lg-6 auth-banners">
                    <div class="bg-login card card-body m-0 h-100 border-0">
                        <img src="{{ asset('assets/images/auth/yoga-chakra-banner.webp') }}" class="img-fluid auth-banner"
                            alt="auth-banner">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="auth-box card card-body m-0 h-100 border-0 justify-content-center">
                        <div class="mb-5 text-center">
                            <h4 class="fw-normal">Welcome to <br><span class="fw-bold text-primary">Central Council for Research in Yoga & Naturopathy (CCRYN)</span></h4>
                        </div>
                        <form class="form-custom mt-10" role="form" id="formLogin" name="formLogin" action="{{ url('admin/login') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="mb-5">
                                <label class="form-label" for="login-email">Username<span class="text-danger ms-1">*</span>
                                </label>
                                <input type="text" name="username" class="form-control" id="login-email" placeholder="Enter your email">
                            </div>

                            <div class="mb-5">
                                <label class="form-label" for="LoginPassword">Password<span
                                        class="text-danger ms-1">*</span></label>
                                <div class="input-group">
                                    <input type="password" id="LoginPassword" class="form-control" name="password"
                                        placeholder="Enter your password" data-visible="false">
                                    <a class="input-group-text bg-transparent toggle-password" href="javascript:;"
                                        data-target="password">
                                        <i class="ri-eye-off-line text-muted toggle-icon"></i>
                                    </a>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary rounded-2 w-100 btn-loader" id="btnLogin">
                                <span class="indicator-label">
                                    Sign In <i class="fa fa-spin fa-spinner d-none"></i>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/app-custom.js') }}"></script>

    <script type="text/javascript">
        var elm = $('form[name=formLogin]');
        stsPanel_JS.Forms_Submit(elm.find('#btnLogin'), elm, true, '', (response) => {});
    </script>
@endsection
