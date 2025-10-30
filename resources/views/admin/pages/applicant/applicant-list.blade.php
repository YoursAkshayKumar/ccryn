@extends('admin.partials.layouts.master')

@section('title', 'Applicant | Central Council for Research in Yoga & Naturopathy (CCRYN)')

@section('sub-title', 'Applicants')
@section('pagetitle', 'Applicants')
@section('buttonTitle', 'Add Applicant')
@section('link', 'admin/applicant-add')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
@endsection

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card mb-0 h-100">
            <div class="row align-items-end p-4">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <form id="frmApplicantFilter" name="frmStudentsFilter" type="form" method="post" autocomplete="off" onsubmit="return false;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="filter-box">
                            <div class="row align-items-end">
                                <div class="col-sm-2">
                                    <label for="carriers">Search</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="search" class="form-control" placeholder="">
                                </div>
                                <div class="col-sm-2 text-right">
                                    <button type="button" class="btn btn-primary btn-sm applicant-filter-btn-go">Go!</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table id="applicantsTable" class="data-table-basic table-hover align-middle table table-nowrap w-100">
                <thead class="bg-light bg-opacity-30">
                    <tr>
                        <th data-visible="false">&nbsp;</th>
                        <th>Applicant Number</th>
                        <th>Applicant Name</th>
                        <th>Father Name</th>
                        <th data-orderable="false">Mobile</th>
                        <th data-orderable="false">Gender</th>
                        <th data-orderable="false">Image</th>
                        <th data-orderable="false">Uplaod Result</th>
                        <th data-orderable="false">Update Status</th>
                        <th data-orderable="false">Edit</th>
                        <th data-orderable="false">Delete</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@section('js')

<!-- Datatable js -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- Datatable init -->
<!-- <script src="{{ asset('assets/js/table/datatable.init.js') }}"></script> -->

<script type="text/javascript">
    $(document).ready(function() {
        var tblUsers = $('#applicantsTable').DataTable({
            'scrollX': true,
            'scrollCollapse': true,
            'scrollY': screen.height / 2.3,
            /**********************/
            'dom': 'rtip',
            'processing': true,
            'serverSide': true,
            'ajax': {
                url: "{{ url(env('ADMIN_URL_PREFIX') . '/applicant-ajax-load') }}",
                type: 'POST',
                data: function(d) {
                    d["_token"] = "{{ csrf_token() }}";
                    d.frmData = $("#frmApplicantFilter").serialize();
                },
            },
            'initComplete': function(settings, json) {
                // Initialize tooltip to show notification icon for near renewal date bound policies.
                $('[data-toggle="tooltip"]').tooltip();
            },
            'drawCallback': function(setings, json) {
                // Initialize tooltip to show notification icon for near renewal date bound policies.
                $('[data-toggle="tooltip"]').tooltip();
            },
            // "order": [[ 0, "asc" ]],
            "order": [
                [0, "desc"]
            ],
            'columns': [{
                    name: 'created_at',
                    data: 'created_at',
                    visible: false
                },
                {
                    name: 'application_no',
                    render: function(data, type, row, meta) {
                        let cnt = row.application_no;
                        return cnt;
                    }
                },
                {
                    name: 'applicant_name',
                    render: function(data, type, row, meta) {
                        return row.applicant_name;
                    }
                },
                {
                    name: 'fathers_name',
                    render: function(data, type, row, meta) {
                        return row.fathers_name;
                    }
                },
                {
                    name: 'mobile_no',
                    render: function(data, type, row, meta) {
                        return row.mobile_no;
                    }
                },
                {
                    name: 'gender',
                    render: function(data, type, row, meta) {
                        if (row.gender === null) {
                            data = 'Other';
                        } else {
                            data = row.gender;
                        }
                        return data;
                    }
                },
                {
                    name: 'image',
                    render: function(data, type, row, meta) {
                        if (row.image != '') {
                            data =
                                `<img src="{{ asset('/') }}${row.photo_url}" class="img-fluid img-admin-user">`
                        } else {
                            if (row.gender == 'F') {
                                data =
                                    `<img src="{{ url('assets/images/user/female.png') }}" class="img-fluid img-admin-user">`
                            } else if (row.gender == 'M') {
                                data =
                                    `<img src="{{ url('assets/images/user/male.png') }}" class="img-fluid img-admin-user">`
                            } else {
                                data =
                                    `<img src="{{ url('assets/images/user/user.png') }}/" class="img-fluid img-admin-user">`
                            }
                        }
                        return data;
                    }
                },
                {
                    render: function(data, type, row, meta) {
                        data = `<div class="hstack gap-2 fs-15">
                                    <a href="{{ url(env('ADMIN_URL_PREFIX') . '/applicant-upload-result') }}/${row.applicant_id}" class="btn icon-btn-sm btn-light-primary">
                                        <i class="ri-chat-upload-line"></i>
                                    </a>
                                </div>`;
                        return data;
                    },
                    orderable: false
                },
                {
                    render: function(data, type, row, meta) {
                        data = `<div class="hstack gap-2 fs-15">
                                    <a href="{{ url(env('ADMIN_URL_PREFIX') . '/applicant-status-edit') }}/${row.applicant_id}" class="btn icon-btn-sm btn-light-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>`;
                        return data;
                    },
                    orderable: false
                },
                {
                    render: function(data, type, row, meta) {
                        data = `<div class="hstack gap-2 fs-15">
                                    <a href="{{ url(env('ADMIN_URL_PREFIX') . '/applicant-edit') }}/${row.applicant_id}" class="btn icon-btn-sm btn-light-primary">
                                        <i class="ri-pencil-line"></i>
                                    </a>
                                </div>`;
                        return data;
                    },
                    orderable: false
                },
                {
                    render: function(data, type, row, meta) {
                        data = `<div class="hstack gap-2 fs-15">
                                      <a href="{{ url(env('ADMIN_URL_PREFIX') . '/applicant-delete') }}/${row.applicant_id}" class="btn icon-btn-sm btn-light-danger delete-item">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                </div>`;
                        return data;
                    },
                    orderable: false
                },
            ],
        });

        $('.applicant-filter-btn-go').off('click').on('click', function() {
            tblUsers.ajax.reload();
        });
    });
</script>


<!-- App js -->
<script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection