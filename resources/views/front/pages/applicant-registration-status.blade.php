@extends('front.partials.layouts.front')

@section('title', '')
@section('sub-title', '' )
@section('pagetitle', 'Request for Pharmacist Registration')
@section('buttonTitle', '')



@section('content')
<!-- <div class="e-commerce-dashboard">
    <div class="row">
    </div>
</div> -->

<div class="container mt-4">
    <h4>Application Status</h4>

    <table class="table table-bordered">
        @foreach($statuses as $step)
        <tr>
            <td width="70%">
                {{ $step->step_no }} {{ $step->step_name }}
            </td>
            <td>
                @if($step->download_link)
                    <a href="{{ asset($step->download_link) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-download"></i> Download
                    </a>
                @else
                    @if($step->status == 'Accepted')
                        <span class="text-success">✔ Accepted</span>
                    @elseif($step->status == 'Rejected')
                        <span class="text-danger">✖ Rejected</span>
                    @else
                        <span class="text-warning">⏳ Pending</span>
                    @endif
                    @if($step->updated_at)
                        {{ \Carbon\Carbon::parse($step->updated_at)->format('d/m/Y') }}
                    @endif
                @endif            
            </td>
        </tr>
        @endforeach
    </table>

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