@extends('admin.partials.layouts.master3')

@section('title', 'Add User | Central Council for Research in Yoga & Naturopathy (CCRYN)')
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
    <h5 class="mb-0">User Add</h5>
  </div>
  <div class="card-body add-post">
    <form name="frmAddAdminUser" type="form"
      action="{{ url(env('ADMIN_URL_PREFIX') . '/admin-user-add') }}" method="post"
      autocomplete="off" enctype="multipart/form-data" class="frm-admin-user">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="row mb-1">
        <div class="form-group col-md-6">
          <label for="first_name">First Name</label>
          <input type="text" id="first_name" class="form-control" placeholder="First Name" name="first_name"
            required="">
        </div>
        <div class="form-group col-md-6">
          <label for="last_name">Last Name</label>
          <input type="text" id="last_name" class="form-control" placeholder="Last Name" name="last_name"
            required="">
        </div>
      </div>

      <div class="row mb-1">
        <div class="form-group col-md-6">
          <label for="username">Username</label>
          <input type="text" id="username" class="form-control" placeholder="Username" name="username"
            required="">
        </div>
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" id="email" class="form-control" placeholder="Email" name="email"
            required="">
        </div>
      </div>

      <div class="row mb-1">
        <div class="form-group col-md-6">
          <label class="col-form-label" for="mobile">Mobile Number</label>
          <div class="input-group mb-3">
            <input type="text" id="mobile" name="mobile" class="form-control us_telephone" placeholder="+91-8888888888" required="">
          </div>
        </div>

        <div class="form-group col-md-6">
          <br><label>Gender</label><br>
          <div class="form-group d-inline">
            <div class="radio radio-primary d-inline">
              <input type="radio" id="radio-in-1" value="M" name="gender">
              <label for="radio-in-1" class="cr">Male</label>
            </div>
          </div>
          <div class="form-group d-inline">
            <div class="radio radio-primary d-inline">
              <input type="radio" id="radio-in-2" value="F" name="gender">
              <label for="radio-in-2" class="cr">Female</label>
            </div>
          </div>
          <div class="form-group d-inline">
            <div class="radio radio-primary d-inline">
              <input type="radio" id="radio-in-3" value="NB" name="gender">
              <label for="radio-in-3" class="cr">Non Binary</label>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-1">
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input type="password" id="password" class="form-control" placeholder="Password" name="password"
            required="" autocomplete="new-password">
        </div>
        <div class="form-group col-md-6">
          <label for="cpassword">Confirm Password</label>
          <input type="password" id="cpassword" class="form-control" placeholder="Confirm Password"
            name="cpassword" required="">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-sm-6">
          <label>Image</label>
          <input type="file" name="image" accept="image/*" class="form-control" id="imgInp">
        </div>
        <div class="form-group col-sm-6">
          <img id="preview" src="#" class="img-fluid img-admin-user"
            onerror="this.style.display='none'" onload="this.style.display=''">
        </div>
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