@extends('admin.partials.layouts.master3')

@section('title', 'Add Applicant | Central Council for Research in Yoga & Naturopathy (CCRYN)')
@section('sub-title', 'Add Applicants' )
@section('pagetitle', 'Applicants')
@section('buttonTitle', 'Applicants Add')
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
        <h5 class="mb-0">Add Applicant</h5>
    </div>
    <div class="card-body add-post">
        <form name="frmAddApplicant" type="form"
            action="{{ url(env('ADMIN_URL_PREFIX') . '/applicant-add') }}" method="post"
            autocomplete="off" enctype="multipart/form-data" class="frm-admin-user">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <!-- ============== Applicant Details S=============== -->
            <div class="card mb-4">
                <div class="card-header">Applicant Details</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label>Application No</label>
                        <input type="text" name="application_no" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Applicant Name</label>
                        <input type="text" name="applicant_name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Place of Birth</label>
                        <input type="text" name="place_of_birth" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Father's Name</label>
                        <input type="text" name="fathers_name" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Religion</label>
                        <input type="text" name="religion" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label>Mobile No</label>
                        <input type="text" name="mobile_no" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Aadhaar No</label>
                        <input type="text" name="aadhaar_no" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Nationality</label>
                        <input type="text" name="nationality" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Enrollment No</label>
                        <input type="text" name="enrollment_no" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Roll No</label>
                        <input type="text" name="roll_no" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Highest Degree</label>
                        <input type="text" name="highest_degree" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Signature</label>
                        <input type="file" name="signature" class="form-control">
                    </div>
                </div>
            </div>

            <!-- ============== Address Section =============== -->
            <!-- ========================== -->
            <!-- Permanent Address Section -->
            <!-- ========================== -->
            <h4 class="mt-4 mb-2 fw-bold">Permanent Address</h4>
            <div class="row border rounded p-3 mb-3">
                <div class="col-md-4 mb-3">
                    <label>House No</label>
                    <input type="text" name="permanent_house_no"
                        value=""
                        class="form-control" placeholder="House No">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Village/Locality</label>
                    <input type="text" name="permanent_village_locality"
                        value=""
                        class="form-control" placeholder="Village or Locality">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Police Station</label>
                    <input type="text" name="permanent_police_station"
                        value=""
                        class="form-control" placeholder="Police Station">
                </div>

                <div class="col-md-4 mb-3">
                    <label>District</label>
                    <input type="text" name="permanent_district"
                        value=""
                        class="form-control" placeholder="District">
                </div>

                <div class="col-md-4 mb-3">
                    <label>State</label>
                    <input type="text" name="permanent_state"
                        value=""
                        class="form-control" placeholder="State">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Country</label>
                    <input type="text" name="permanent_country"
                        value=""
                        class="form-control" placeholder="Country">
                </div>

                <div class="col-md-4 mb-3">
                    <label>PIN Code</label>
                    <input type="text" name="permanent_pin_code"
                        value=""
                        class="form-control" placeholder="PIN Code">
                </div>
            </div>

            <!-- ========================== -->
            <!-- Correspondence Address Section -->
            <!-- ========================== -->
            <h4 class="mt-4 mb-2 fw-bold">Correspondence Address</h4>
            <div class="row border rounded p-3 mb-3">
                <div class="col-md-4 mb-3">
                    <label>House No</label>
                    <input type="text" name="correspondence_house_no"
                        value=""
                        class="form-control" placeholder="House No">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Village/Locality</label>
                    <input type="text" name="correspondence_village_locality"
                        value=""
                        class="form-control" placeholder="Village or Locality">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Police Station</label>
                    <input type="text" name="correspondence_police_station"
                        value=""
                        class="form-control" placeholder="Police Station">
                </div>

                <div class="col-md-4 mb-3">
                    <label>District</label>
                    <input type="text" name="correspondence_district"
                        value=""
                        class="form-control" placeholder="District">
                </div>

                <div class="col-md-4 mb-3">
                    <label>State</label>
                    <input type="text" name="correspondence_state"
                        value=""
                        class="form-control" placeholder="State">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Country</label>
                    <input type="text" name="correspondence_country"
                        value=""
                        class="form-control" placeholder="Country">
                </div>

                <div class="col-md-4 mb-3">
                    <label>PIN Code</label>
                    <input type="text" name="correspondence_pin_code"
                        value=""
                        class="form-control" placeholder="PIN Code">
                </div>
            </div>

            <!-- ============= Education Section (Multiple Entries) ============= -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Educational Qualifications</span>
                    <button type="button" id="addEducation" class="btn btn-sm btn-success">+ Add More</button>
                </div>

                <div class="card-body" id="educationSection">
                    <!-- One Education Row Template -->
                    <div class="education-row border rounded p-3 mb-3">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label>Qualification Name</label>
                                <input type="text" name="education[0][qualification_name]" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Examining Body</label>
                                <input type="text" name="education[0][examining_body]" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Institution Name</label>
                                <input type="text" name="education[0][institution_name]" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <label>Start Year</label>
                                <input type="number" name="education[0][course_start_year]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label>End Year</label>
                                <input type="number" name="education[0][course_end_year]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label>Max Marks</label>
                                <input type="number" name="education[0][maximum_marks]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label>Obtained Marks</label>
                                <input type="number" name="education[0][obtained_marks]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label>%</label>
                                <input type="text" name="education[0][secured_percentage]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label>CGPA</label>
                                <input type="text" name="education[0][cgpa]" class="form-control">
                            </div>

                            <div class="col-md-12 text-end">
                                <button type="button" class="btn btn-danger btn-sm removeEducation mt-2">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======== Internship Section ============== -->
            <div class="card mb-4">
                <div class="card-header">Internship Details</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label>Organization Name</label>
                        <input type="text" name="organization_name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Address</label>
                        <input type="text" name="internship_address" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>District</label>
                        <input type="text" name="internship_district" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Start Date</label>
                        <input type="date" name="internship_start" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>End Date</label>
                        <input type="date" name="internship_end" class="form-control">
                    </div>
                </div>
            </div>

            <!-- ================Documents Section (Fixed Required List) =============== -->
            <div class="card mb-4">
                <div class="card-header">Documents Upload</div>
                <div class="card-body row g-3">
                    @php
                    $requiredDocuments = [
                    'High School Marksheet',
                    'Intermediate Marksheet',
                    'D.Pharm Part-I Marksheet',
                    'D.Pharm Part-II Marksheet',
                    'Diploma Certificate',
                    'Domicile Certificate',
                    'Aadhaar Card'
                    ];
                    @endphp

                    @foreach($requiredDocuments as $index => $doc)
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">{{ $doc }}</label>
                        <input type="hidden" name="documents[{{ $index }}][document_name]" value="{{ $doc }}">
                        <input type="file" name="documents[{{ $index }}][file_url]" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center">
                <button type="button" id="btnSubmit" class="btn btn-primary px-5 py-2">Submit Application</button>
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
    var elm = $('form[name=frmAddApplicant]');
    stsPanel_JS.Forms_Submit(elm.find('#btnSubmit'), elm, true, '', (response) => {});
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

@endsection