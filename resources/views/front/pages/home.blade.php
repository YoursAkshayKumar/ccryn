
@extends('front.partials.layouts.front')

    @section('title', '')
    @section('sub-title', '' )
    @section('pagetitle', 'Dashboard')
    @section('buttonTitle', '')
    @section('link', '')
  

    @section('content')
    <div class="e-commerce-dashboard">
        <div class="row">
            <div class="col-lg-3">
                <a href="{{ url('request-for-pharmacist-registration') }}">
                    <div class="card card-h-100 overflow-hidden">
                        <div class="card-body p-4">
                            <div class="hstack flex-wrap justify-content-between gap-3 align-items-end">
                                <div class="flex-grow-1">
                                    <div class="gap-3 mb-3 d-flex flex-column justify-content-center align-items-center">
                                        <div class="bg-warning-subtle text-warning avatar avatar-item rounded-2">
                                            <i class="bi bi bi-bag-plus-fill fs-16 fw-medium"></i>
                                        </div>
                                        <h6 class="mb-0 fs-13">1. Request for Pharmacist Registration</h6>
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
                        <!-- <div id="totalSalesDashborad"></div> -->
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <!-- <div class="card card-h-100 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="hstack flex-wrap justify-content-between gap-3 align-items-end">
                            <div class="flex-grow-1">
                                <div class="hstack gap-3 mb-3">
                                    <div class="bg-danger-subtle text-danger avatar avatar-item rounded-2">
                                        <i class="ri-money-dollar-circle-line fs-16 fw-medium"></i>
                                    </div>
                                    <h6 class="mb-0 fs-13">Total </h6>
                                </div>
                                <h4 class="fw-semibold fs-5 mb-0">
                                    <span data-target="202557" data-duration="5" data-prefix="$">$202557</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="d-flex align-items-end justify-content-end gap-3">
                                    <span class="text-danger"><i class="ri-arrow-right-down-line fs-12"></i>1.01%</span>
                                </div>
                                <div class="text-muted fs-12">-0.31% this week</div>
                            </div>
                        </div>
                    </div>
                    <div id="totalOrdersDashborad"></div>
                </div> -->
            </div>
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
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