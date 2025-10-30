@extends('admin.partials.layouts.master')

@section('title', 'Admin Users | Central Council for Research in Yoga & Naturopathy (CCRYN)')

@section('sub-title', 'Admin Users')
@section('pagetitle', 'Admin Users')
@section('buttonTitle', 'Add User')
@section('link', 'admin/admin-user-add')

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
                    <form id="frmAgentFilter" name="frmUsersFilter" type="form"
                        method="post" autocomplete="off" onsubmit="return false;">
                        <input type="hidden" name="_token"
                            value="{{ csrf_token() }}" />

                        <div class="filter-box">
                            <div class="row align-items-end">
                                <div class="col-sm-2">
                                    <label for="carriers">Search</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="search" class="form-control" placeholder="">
                                </div>
                                <div class="col-sm-2 text-right">
                                    <button type="button" class="btn btn-primary btn-sm user-filter-btn-go">Go!</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table id="usersTable" class="data-table-basic table-hover align-middle table table-nowrap w-100">
                <thead class="bg-light bg-opacity-30">
                    <tr>
                        <th data-visible="false">&nbsp;</th>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th data-orderable="false">Mobile</th>
                        <th data-orderable="false">Gender</th>
                        <th data-orderable="false">Image</th>
                        <th data-orderable="false">Last Login</th>
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

        var tblUsers = $('#usersTable').DataTable({
            'scrollX': true,
            'scrollCollapse': true,
            'scrollY': screen.height / 2.3,
            /**********************/
            'dom': 'rtip',
            'processing': true,
            'serverSide': true,
            'ajax': {
                url: "{{ url(env('ADMIN_URL_PREFIX') . '/admin-user-ajax-load') }}",
                type: 'POST',
                data: function(d) {
                    d["_token"] = "{{ csrf_token() }}";
                    d.frmData = $("#frmUsersFilter").serialize();
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
                    name: 'created_on',
                    data: 'created_on',
                    visible: false
                },
                {
                    name: 'admin_id',
                    render: function(data, type, row, meta) {
                       
                        let cnt = row.admin_id;
                        return cnt;
                    }
                },
                {
                    name: 'first_name',
                    render: function(data, type, row, meta) {
                        return row.first_name;
                    }
                },
                {
                    name: 'last_name',
                    render: function(data, type, row, meta) {
                        return row.last_name;
                    }
                },
                {
                    name: 'username',
                    render: function(data, type, row, meta) {
                        return row.username;
                    }
                },
                {
                    name: 'Email',
                    render: function(data, type, row, meta) {
                        return row.email;
                    }
                },
                {
                    name: 'mobile',
                    render: function(data, type, row, meta) {
                        return row.mobile;
                    }
                },
                {
                    name: 'gender',
                    render: function(data, type, row, meta) {
                        if (row.gender == 'F') {
                            data = 'Female';
                        } else if (row.gender == 'M') {
                            data = 'Male';
                        } else {
                            data = 'Other';
                        }
                        return data;
                    }
                },
                {
                    name: 'image',
                    render: function(data, type, row, meta) {
                        if (row.image != '') {
                            data =
                                `<img src="{{ url('assets/images/admin/profile') }}/${row.image}" class="img-fluid img-admin-user">`
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
                    name: 'last_login',
                    render: function(data, type, row, meta) {
                        let date = '';
                        if (row.last_login != null) {
                            data = moment(row.last_login).format('MM/DD/YYYY');
                        } else {
                            data = '';
                        }
                        return data;
                    }
                },
                {
                    render: function(data, type, row, meta) {
                        data = `<div class="hstack gap-2 fs-15">
                                    <a href="{{ url(env('ADMIN_URL_PREFIX') . '/admin-user-edit') }}/${row.admin_id}" class="btn icon-btn-sm btn-light-primary">
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
                                      <a href="{{ url(env('ADMIN_URL_PREFIX') . '/admin-user-delete') }}/${row.admin_id}" class="btn icon-btn-sm btn-light-danger delete-item">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                </div>`;
                        return data;
                    },
                    orderable: false
                },
            ],
        });

        $('.user-filter-btn-go').off('click').on('click', function() {
            tblUsers.ajax.reload();
        });
    });
</script>


<!-- App js -->
<script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection