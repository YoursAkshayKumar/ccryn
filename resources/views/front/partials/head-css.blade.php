{{-- Layout JS --}}
<script src="{{ asset('assets/js/vendor-all-new.js') }}"></script>

@if(request()->segment(1) != 'applicant-login')
<script src="{{ asset('assets/js/layout/layout-default.js') }}"></script>
@endif

<script src="{{ asset('assets/js/layout/layout.js') }}"></script>

<script src="{{ asset('assets/plugins/jquery-validation-1.17.0/dist/jquery.validate.min.js') }}"></script>


{{-- CSS Dependencies --}}
<link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style">
<link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}" id="app-style">
<link rel="stylesheet" href="{{ asset('assets/css/custom.min.css') }}" id="custom-style">
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/front-style.css') }}" />
