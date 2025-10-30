@extends('admin.partials.layouts.master3')

@section('title', 'Upload Applicant Result | Central Council for Research in Yoga & Naturopathy (CCRYN)')
@section('sub-title', '' )
@section('pagetitle', 'Upload Applicant Result')
@section('buttonTitle', 'Applicants List')
@section('link', 'admin/applicants')

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
        <h5 class="mb-0">Upload Result</h5>
    </div>
    <div class="card-body add-post">
        <form name="frmUploadResult" type="form"
            action="{{ url(env('ADMIN_URL_PREFIX') . '/applicant-upload-result') }}" method="post"
            autocomplete="off" enctype="multipart/form-data" class="frm-admin-user">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="applicant_id" value="{{ $id }}" />

            <div class="card mb-4">
                <div class="card-header">Applicant Details</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label>Result Title</label>
                        <input type="text" name="result_title" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Result File</label>
                        <input type="file" name="result_file" class="form-control">
                         <p>
                            <a href="{{ asset($existing->result_file_url) }}" target="_blank">View Existing</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="button" id="btnSubmit" class="btn btn-primary px-5 py-2">Submit</button>
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
    var elm = $('form[name=frmUploadResult]');
    stsPanel_JS.Forms_Submit(elm.find('#btnSubmit'), elm, true, '', (response) => {});
</script>

@endsection