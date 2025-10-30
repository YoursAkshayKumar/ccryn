@extends('front.partials.layouts.front')

@section('title', '')
@section('sub-title', '' )
@section('pagetitle', 'Request for Pharmacist Registration')
@section('buttonTitle', '')



@section('content')
<div class="e-commerce-dashboard">
    <div class="row">
        <div class="col-lg-3">
            <a href="{{ url('required-documents/Document-Required.pdf') }}">
                <div class="card card-h-100 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="hstack flex-wrap justify-content-center gap-3 align-items-end">
                            <div class="flex-grow-1">
                                <div class="gap-3 mb-3 d-flex flex-column justify-content-center align-items-center">
                                    <div class="bg-warning-subtle text-warning avatar avatar-item rounded-2">
                                        <i class="bi bi-file-earmark-arrow-down fs-16 fw-medium"></i>
                                    </div>
                                    <h6 class="mb-0 fs-13">Documents Required</h6>
                                </div>
                                <!-- <h4 class="fw-semibold fs-5 mb-0">
                                        <span data-target="84573" data-duration="5" data-prefix="$">$84573</span>
                                    </h4> -->
                            </div>
                            <!-- <div class="flex-shrink-0 text-end">
                                    <div class="d-flex align-items-end justify-content-end gap-3">
                                        <span class="text-success"><i class="ri-arrow-right-up-line fs-12"></i>10.18%</span>
                                    </div>
                                    <div class="text-muted fs-12">+1.01% this week</div>
                                </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="{{ url('view-application-status/'. $applicantId) }}">
                <div class="card card-h-100 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="hstack flex-wrap justify-content-center gap-3 align-items-end">
                            <div class="flex-grow-1">
                                <div class="gap-3 mb-3 d-flex flex-column justify-content-center align-items-center">
                                    <div class="bg-danger-subtle text-danger avatar avatar-item rounded-2">
                                        <i class="bi bi-file-earmark-text-fill fs-16 fw-medium"></i>
                                    </div>
                                    <h6 class="mb-0 fs-13">View Registration Application Status</h6>
                                </div>
                                <!-- <h4 class="fw-semibold fs-5 mb-0">
                                    <span data-target="202557" data-duration="5" data-prefix="$">$202557</span>
                                </h4> -->
                            </div>
                            <!-- <div class="flex-shrink-0 text-end">
                                <div class="d-flex align-items-end justify-content-end gap-3">
                                    <span class="text-danger"><i class="ri-arrow-right-down-line fs-12"></i>1.01%</span>
                                </div>
                                <div class="text-muted fs-12">-0.31% this week</div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
        </div>

        <div class="col-lg-3">
        </div>
    </div>

    <div class="row">
        <div class="table-responsive shadow-sm border rounded">
            <table class="table table-bordered align-middle mb-0">
                <tbody>
                    {{-- Row 1 --}}
                    <tr>
                        <td width="50%">
                            <strong>Application Form Submitted</strong> /
                            आवेदन पत्र जमा किया गया
                        </td>
                        <td width="20%" class="text-success">
                            <i class="fa fa-check-circle"></i>
                            Form Submission Done
                        </td>
                        <td width="30%" class="text-center">
                            <a href="#" class="btn btn-primary btn-sm px-3">
                                Download Application
                            </a>
                        </td>
                    </tr>

                    {{-- Row 2 --}}
                    <!-- <tr>
                        <td>
                            <strong>Application Fee Payment</strong> /
                            आवेदन शुल्क भुगतान
                        </td>
                        <td class="text-success">
                            <i class="fa fa-check-circle"></i>
                            Paid
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary btn-sm px-3">
                                Download Receipt
                            </a>
                        </td>
                    </tr> -->

                    {{-- Row 3 - Red Note --}}
                    <!-- <tr>
                        <td colspan="3" class="text-danger fw-bold">
                            Please click on the link to View/Download the
                            “New Format for the Affidavit” as your application will be accepted
                            only after you submit your affidavit in the new format.
                            <br>
                            कृपया “शपथ पत्र के नए प्रारूप” को देखने/डाउनलोड करने हेतु दिए गए लिंक पर क्लिक करें,
                            नए प्रारूप में एफिडेविट जमा करने के बाद ही आपका आवेदन स्वीकार किया जाएगा।
                        </td>
                    </tr> -->

                    {{-- Optional Row 4 --}}
                    <!-- <tr>
                        <td colspan="2"></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary btn-sm px-4">
                                Download
                            </a>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Countup init -->
<script type="module" src="{{ asset('assets/js/pages/countup.init.js') }}"></script>

<!-- ApexChat js -->
<!-- <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script> -->

<!-- Ecommerce dashboard init -->
<!-- <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script> -->
<!-- <script src="{{ asset('assets/js/dashboards/dashboard-ecommerce.init.js') }}"></script> -->

<!-- App js -->
<script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection