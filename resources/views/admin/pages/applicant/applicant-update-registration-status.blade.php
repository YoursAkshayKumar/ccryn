@extends('admin.partials.layouts.master3')

@section('title', 'Edit Applicant | Central Council for Research in Yoga & Naturopathy (CCRYN)')
@section('sub-title', 'Applicant' )
@section('pagetitle', 'Applicants')
@section('buttonTitle', 'Applicant List')
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
        <h5 class="mb-0">Update Registration Status</h5>
    </div>

    @foreach($statuses as $status)
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light">
            <strong>{{ $status->step_no }}. {{ $status->step_name }}</strong>
        </div>
        <div class="card-body">
            <form name="frmApplicantStatus{{ $status->step_no }}" action="{{ url('admin/applicant-status-update/'. $status->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(in_array($status->step_no, [1,2,3,4]))
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-select">
                                <option value="Pending" {{ $status->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Accepted" {{ $status->status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="Rejected" {{ $status->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                    </div>
                @else
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Upload Certificate/Document (if any)</label>
                            <input type="file" name="download_link" class="form-control">
                            @if($status->download_link)
                                <a href="{{ asset('storage/' . $status->download_link) }}" target="_blank" class="btn btn-outline-success btn-sm mt-2">
                                    View Current File
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                <button type="button" class="btn btn-primary btn-submit">Save Changes</button>
            </form>
        </div>
    </div>
    @endforeach

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
    var elm1 = $('form[name=frmApplicantStatus1]');
    var elm2 = $('form[name=frmApplicantStatus2]');
    var elm3 = $('form[name=frmApplicantStatus3]');
    var elm4 = $('form[name=frmApplicantStatus4]');
    var elm5 = $('form[name=frmApplicantStatus5]');
    stsPanel_JS.Forms_Submit(elm1.find('.btn-submit'), elm1, true, '', (response) => {});
    stsPanel_JS.Forms_Submit(elm2.find('.btn-submit'), elm2, true, '', (response) => {});
    stsPanel_JS.Forms_Submit(elm3.find('.btn-submit'), elm3, true, '', (response) => {});
    stsPanel_JS.Forms_Submit(elm4.find('.btn-submit'), elm4, true, '', (response) => {});
    stsPanel_JS.Forms_Submit(elm5.find('.btn-submit'), elm5, true, '', (response) => {});
</script>

<!-- Template for Education Row -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let eduIndex = {
            {
                isset($applicant) ? $applicant - > educations - > count() : 1
            }
        };
        const wrapper = document.getElementById('education-wrapper');

        document.getElementById('add-education').addEventListener('click', function() {
            let html = `{!! str_replace(["\n", "\r"], '', addslashes(view('admin.pages.applicant.partials.education_row', ['edu' => null, 'index' => '__INDEX__'])->render())) !!}`;
            html = html.replace(/__INDEX__/g, eduIndex++);
            wrapper.insertAdjacentHTML('beforeend', html);
        });
    });
</script>

<!-- Education Duplicate form Javascript -->
<script>
    let eduIndex = 1;

    document.getElementById('addEducation').addEventListener('click', function() {
        const section = document.getElementById('educationSection');
        const newRow = document.querySelector('.education-row').cloneNode(true);

        // Update name attributes dynamically
        newRow.querySelectorAll('input').forEach((input) => {
            input.value = '';
            input.name = input.name.replace(/\[\d+\]/, '[' + eduIndex + ']');
        });

        section.appendChild(newRow);
        eduIndex++;
    });

    // Remove Education Entry
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('removeEducation')) {
            const rows = document.querySelectorAll('.education-row');
            if (rows.length > 1) {
                e.target.closest('.education-row').remove();
            } else {
                alert('At least one education record is required.');
            }
        }
    });
</script>

<script>
    function copyPermanentAddress() {
        const checked = document.getElementById('sameAsPermanent').checked;
        if (checked) {
            document.querySelector('[name="correspondence_address_line"]').value = document.querySelector('[name="permanent_address_line"]').value;
            document.querySelector('[name="correspondence_city"]').value = document.querySelector('[name="permanent_city"]').value;
            document.querySelector('[name="correspondence_state"]').value = document.querySelector('[name="permanent_state"]').value;
            document.querySelector('[name="correspondence_country"]').value = document.querySelector('[name="permanent_country"]').value;
            document.querySelector('[name="correspondence_pincode"]').value = document.querySelector('[name="permanent_pincode"]').value;
        }
    }
</script>

@endsection