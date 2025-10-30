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
        <h5 class="mb-0">Edit Applicant</h5>
    </div>
    <div class="card-body add-post">
        <form name="frmEditApplicant" type="form"
            action="{{ url(env('ADMIN_URL_PREFIX') . '/applicant-edit/'. $applicant->applicant_id ) }}" method="post"
            autocomplete="off" enctype="multipart/form-data" class="frm-admin-user">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="applicant_id" value="{{ $applicant->applicant_id }}">

            <div class="container my-4">
                <h3 class="mb-4">
                    {{ isset($applicant) ? 'Edit Applicant Details' : 'Add New Applicant' }}
                </h3>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- ============ Applicant Personal Details ========== -->
                <div class="card mb-4">
                    <div class="card-header fw-bold">Applicant Details</div>
                    <div class="card-body row g-3">
                        <div class="col-md-4">
                            <label>Application No</label>
                            <input type="text" name="application_no" value="{{ old('application_no', $applicant->application_no ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Applicant Name</label>
                            <input type="text" name="applicant_name" value="{{ old('applicant_name', $applicant->applicant_name ?? '') }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select</option>
                                <option value="Male" {{ old('gender', $applicant->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $applicant->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" value="{{ old('dob', $applicant->dob ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Place of Birth</label>
                            <input type="text" name="place_of_birth" value="{{ old('place_of_birth', $applicant->place_of_birth ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Father's Name</label>
                            <input type="text" name="fathers_name" value="{{ old('fathers_name', $applicant->fathers_name ?? '') }}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>Category</label>
                            <input type="text" name="category" value="{{ old('category', $applicant->category ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Religion</label>
                            <input type="text" name="religion" value="{{ old('religion', $applicant->religion ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Mobile No</label>
                            <input type="text" name="mobile_no" value="{{ old('mobile_no', $applicant->mobile_no ?? '') }}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>Aadhaar No</label>
                            <input type="text" name="aadhaar_no" value="{{ old('aadhaar_no', $applicant->aadhaar_no ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Nationality</label>
                            <input type="text" name="nationality" value="{{ old('nationality', $applicant->nationality ?? '') }}" class="form-control">
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
                            value="{{ old('permanent_house_no', $applicant->address->permanent_house_no ?? '') }}"
                            class="form-control" placeholder="House No">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Village/Locality</label>
                        <input type="text" name="permanent_village_locality"
                            value="{{ old('permanent_village_locality', $applicant->address->permanent_village_locality ?? '') }}"
                            class="form-control" placeholder="Village or Locality">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Police Station</label>
                        <input type="text" name="permanent_police_station"
                            value="{{ old('permanent_police_station', $applicant->address->permanent_police_station ?? '') }}"
                            class="form-control" placeholder="Police Station">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>District</label>
                        <input type="text" name="permanent_district"
                            value="{{ old('permanent_district', $applicant->address->permanent_district ?? '') }}"
                            class="form-control" placeholder="District">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>State</label>
                        <input type="text" name="permanent_state"
                            value="{{ old('permanent_state', $applicant->address->permanent_state ?? '') }}"
                            class="form-control" placeholder="State">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Country</label>
                        <input type="text" name="permanent_country"
                            value="{{ old('permanent_country', $applicant->address->permanent_country ?? '') }}"
                            class="form-control" placeholder="Country">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>PIN Code</label>
                        <input type="text" name="permanent_pin_code"
                            value="{{ old('permanent_pin_code', $applicant->address->permanent_pin_code ?? '') }}"
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
                            value="{{ old('correspondence_house_no', $applicant->address->correspondence_house_no ?? '') }}"
                            class="form-control" placeholder="House No">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Village/Locality</label>
                        <input type="text" name="correspondence_village_locality"
                            value="{{ old('correspondence_village_locality', $applicant->address->correspondence_village_locality ?? '') }}"
                            class="form-control" placeholder="Village or Locality">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Police Station</label>
                        <input type="text" name="correspondence_police_station"
                            value="{{ old('correspondence_police_station', $applicant->address->correspondence_police_station ?? '') }}"
                            class="form-control" placeholder="Police Station">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>District</label>
                        <input type="text" name="correspondence_district"
                            value="{{ old('correspondence_district', $applicant->address->correspondence_district ?? '') }}"
                            class="form-control" placeholder="District">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>State</label>
                        <input type="text" name="correspondence_state"
                            value="{{ old('correspondence_state', $applicant->address->correspondence_state ?? '') }}"
                            class="form-control" placeholder="State">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Country</label>
                        <input type="text" name="correspondence_country"
                            value="{{ old('correspondence_country', $applicant->address->correspondence_country ?? '') }}"
                            class="form-control" placeholder="Country">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>PIN Code</label>
                        <input type="text" name="correspondence_pin_code"
                            value="{{ old('correspondence_pin_code', $applicant->address->correspondence_pin_code ?? '') }}"
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
                        @if(isset($applicant) && $applicant->educations->count() > 0)
                        @foreach($applicant->educations as $index => $edu)
                        @include('admin.pages.applicant.partials.education_row', ['edu' => $edu, 'index' => $index])
                        @endforeach
                        @else
                        @include('admin.pages.applicant.partials.education_row', ['edu' => null, 'index' => 0])
                        @endif
                    </div>
                </div>

                <!-- ============ Internship ========== -->
                <div class="card mb-4">
                    <div class="card-header fw-bold">Internship Details</div>
                    <div class="card-body row g-3">
                        <div class="col-md-4">
                            <label>Hospital / Organization Name</label>
                            <input type="text" name="organization_name" value="{{ old('organization_name', $applicant->internship->organization_name ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Address</label>
                            <input type="text" name="internship_address" value="{{ old('internship_address', $applicant->internship->address ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>District</label>
                            <input type="text" name="internship_district" value="{{ old('internship_district', $applicant->internship->district ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Start Date</label>
                            <input type="date" name="internship_start" value="{{ old('internship_start', $applicant->internship->internship_start ?? '') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>End Date</label>
                            <input type="date" name="internship_end" value="{{ old('internship_end', $applicant->internship->internship_end ?? '') }}" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- ============ Document Upload (Fixed)============= -->
                <div class="card mb-4">
                    <div class="card-header fw-bold">Documents Upload</div>
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
                        @php
                        $existing = isset($applicant)
                        ? $applicant->documents->firstWhere('document_name', $doc)
                        : null;
                        @endphp
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">{{ $doc }}</label>
                            <input type="hidden" name="documents[{{ $index }}][document_name]" value="{{ $doc }}">
                            @if($existing)
                            <p>
                                <a href="{{ asset('storage/' . $existing->file_url) }}" target="_blank">View Existing</a>
                            </p>
                            @endif
                            <input type="file" name="documents[{{ $index }}][file_url]" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- ============ Photo + Signature =========== -->
                <div class="card mb-4">
                    <div class="card-header fw-bold">Photo & Signature</div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label>Photo</label>
                            @if(isset($applicant->photo_url))
                            <div><img src="{{ asset('storage/' . $applicant->photo_url) }}" height="80"></div>
                            @endif
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Signature</label>
                            @if(isset($applicant->signature_url))
                            <div><img src="{{ asset('storage/' . $applicant->signature_url) }}" height="50"></div>
                            @endif
                            <input type="file" name="signature" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="button" id="btnSubmit" class="btn btn-primary px-5 py-2">
                        {{ isset($applicant) ? 'Update Applicant' : 'Submit Application' }}
                    </button>
                </div>
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
    var elm = $('form[name=frmEditApplicant]');
    stsPanel_JS.Forms_Submit(elm.find('#btnSubmit'), elm, true, '', (response) => {});
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