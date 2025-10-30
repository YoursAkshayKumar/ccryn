@extends('admin.partials.layouts.master3')

@section('title', 'Edit User | Central Council for Research in Yoga & Naturopathy (CCRYN)')
@section('sub-title', 'Admin Users' )
@section('pagetitle', 'Users')
@section('buttonTitle', 'User List')
@section('link', 'admin/admin-users')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection

@section('content')


<div class="card mb-0">
    <div class="card-header">
        <h5 class="mb-0">Edit User</h5>
    </div>
    <div class="card-body add-post">
        <form name="frmAddAdminUser" type="form"
            action="{{ url(env('ADMIN_URL_PREFIX') . '/admin-user-edit') }}" method="post"
            autocomplete="off" enctype="multipart/form-data" class="frm-admin-user">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="admin_id" value="{{ $adminUser['admin_id'] }}">
            <input type="hidden" name="fileOld" value="{{ $adminUser['image'] }}">
            
            <div class="row mb-1">
                <div class="form-group col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" class="form-control" placeholder="First Name" name="first_name"
                        required="" value="{{ isset($adminUser['first_name']) ? $adminUser['first_name'] : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" class="form-control" placeholder="Last Name" name="last_name"
                        required="" value="{{ isset($adminUser['last_name']) ? $adminUser['last_name'] : '' }}">
                </div>
            </div>

            <div class="row mb-1">
                <div class="form-group col-md-6">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" placeholder="Username" name="username"
                        required="" value="{{ isset($adminUser['username']) ? $adminUser['username'] : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Email" name="email"
                        required="" value="{{ isset($adminUser['email']) ? $adminUser['email'] : '' }}">
                </div>
            </div>

            <div class="row mb-1">
                <div class="form-group col-md-6">
                    <label class="col-form-label" for="mobile">Mobile Number</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control phone_number" name="mobile"
                            placeholder="(888) 888-8888"
                            value="{{ isset($adminUser['mobile']) ? $adminUser['mobile'] : '' }}">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <br><label>Gender</label><br>
                    <div class="form-group d-inline">
                        <div class="radio radio-primary d-inline">
                            <input type="radio" id="radio-in-1" value="M" name="gender"
                                {{ $adminUser['gender'] == 'M' ? 'checked' : '' }}>
                            <label for="radio-in-1" class="cr">Male</label>
                        </div>
                    </div>
                    <div class="form-group d-inline">
                        <div class="radio radio-primary d-inline">
                            <input type="radio" id="radio-in-2" value="F" name="gender"
                                {{ $adminUser['gender'] == 'F' ? 'checked' : '' }}>
                            <label for="radio-in-2" class="cr">Female</label>
                        </div>
                    </div>
                    <div class="form-group d-inline">
                        <div class="radio radio-primary d-inline">
                            <input type="radio" id="radio-in-3" value="NB" name="gender"
                                {{ $adminUser['gender'] == 'NB' ? 'checked' : '' }}>
                            <label for="radio-in-3" class="cr">Non Binary</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-1">
                <div class="form-group col-md-6">
                    <input type="password" id="password" class="form-control" placeholder="Password"
                        name="password" autocomplete="new-password" value="{{ $adminUser['password_text'] }}">
                    <i class="fa fa-eye-slash eye-icon errspan" id="pshowicon"></i>
                    <small>Leave as it is if you don't want to change.</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" id="cpassword" class="form-control" placeholder="Confirm Password"
                        name="cpassword" value="{{ $adminUser['password_text'] }}">
                </div>
            </div>

            <div class="form-row align-items-center">
                <div class="form-group col-sm-5">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" id="imgInp">
                </div>
                <div class="form-group col-sm-4 text-center remove-image-wrapper">
                    @php
                    if (isset($adminUser['image']) == true && empty($adminUser['image']) == false) {
                    $img = url('assets/images/admin/profile') . '/' . $adminUser['image'];
                    } else {
                    if ($adminUser['gender'] == 'F') {
                    $img = url('assets/images/user/female.png');
                    } elseif ($adminUser['gender'] == 'M') {
                    $img = url('assets/images/user/male.png');
                    } else {
                    $img = url('assets/images/user/user.png');
                    }
                    }
                    @endphp
                    <img id="preview" src="<?= $img ?>" class="img-fluid img-admin-user">
                    @if (isset($adminUser['image']) == true && empty($adminUser['image']) == false)
                    <div class="remove-pic overlay">
                        <span class="remove-pic-link text">
                            <!-- <a href="javascript:void(0);" class="btn-remove"> <i class="fa fa-close"></i> Remove
                                Image</a> -->
                        </span>
                    </div>
                    @endif
                </div>
                <div class="form-group col-sm-3 m-0">&nbsp;</div>
            </div>
            <div class="status_summary d-none">
                <div class="alert alert-dismissible" role="alert">
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-4">
                <button class="btn btn-primary" type="button" id="btnSubmit">Save</button>
                <input class="btn btn-light" type="reset" value="Discard">
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<!-- Air Datepicker js -->
<script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

<!-- Dropzone js -->
<script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>

<!-- Editor js -->
<script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

<!-- Blog js -->
<script src="{{ asset('assets/js/pages/blog.init.js') }}"></script>

<!-- App js -->
<script type="module" src="{{ asset('assets/js/app.js') }}"></script>

<script src="{{ asset('assets/js/app-custom.js') }}"></script>

<script type="text/javascript">
    var elm = $('form[name=frmAddAdminUser]');
    stsPanel_JS.Forms_Submit(elm.find('#btnSubmit'), elm, true, '', (response) => {});


    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
        preview.src = URL.createObjectURL(file)
        }
    }
</script>

@endsection