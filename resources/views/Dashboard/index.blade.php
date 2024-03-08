@extends('master')

@section('breadcrumb')
    <div class="mr-auto w-p50">
        <h3 class="page-title border-0">Dashboard</h3>
    </div>
@endsection

@php
    $visitPerDepartment = App\Models\Visitor::join('departments', 'visitors.department_id', '=', 'departments.id')
        ->select('departments.department_name as department_name', DB::raw('count(visitors.id) as visits'))
        ->whereDate('visitors.updated_at', today())
        ->groupBy('departments.department_name')
        ->get();

    $ratePerDepartment = App\Models\Visitor::join('departments', 'visitors.department_id', '=', 'departments.id')
        ->select('departments.department_name as department_name', DB::raw('AVG(visitors.rate)*20 as average_rating'))
        ->whereNotNull('visitors.rate')
        // ->whereDate('visitors.updated_at', today())
        ->groupBy('department_name')
        ->get();

    $underratedThreshold = 3.5*20; // You can adjust this threshold as needed

    $underratedDepartments = $ratePerDepartment->filter(function ($item) use ($underratedThreshold) {
        return $item->average_rating < $underratedThreshold;
    });

@endphp

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p>Today's Overview, {{ date('M d/Y') }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p>Total Visitors</p>
                            <h5>{{ $visitors }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p>Visitors in</p>
                            <h5>{{ $checkedin }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p>Checked-out</p>
                            <h5>{{ $checkedout }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                    <div id="chart"></div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                    <div id="rating-chart"></div>
                    {{-- <p>Rate Threshold: 70%</p>
                    <ul>
                        <li>Departments < 70% are Poor</li>
                        <li>Departments >= 70% are Better</li>
                        @foreach ($underratedDepartments as $department)
                            <li>{{ $department->department_name }} (Average Rating: {{ $department->average_rating }}%)</li>
                        @endforeach
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var options = {
            chart: {
                type: 'bar',
            },
            title: {
                text: 'Number of Visits per Department',
                align: 'center',
                fontFamily: 'Poppins'
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: 'Visits per Department',
                data: @json($visitPerDepartment->pluck('visits')->map('intval'))
            }],
            xaxis: {
                categories: @json($visitPerDepartment->pluck('department_name'))
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();

        // Rating chat per department
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'bar',
                },
                title: {
                text: 'Number of Visits per Department',
                align: 'center',
                fontFamily: 'Poppins'
            },
                series: [{
                    name: 'Average Rating',
                    data: @json($ratePerDepartment->pluck('average_rating'))
                }],
                xaxis: {
                    categories: @json($ratePerDepartment->pluck('department_name'))
                }
            }

            var ratingChart = new ApexCharts(document.querySelector("#rating-chart"), options);

            ratingChart.render();
        });
    </script>

    <script src="{{ asset('vendor/highchartjs/highcharts.js') }}"></script>
    <script src="{{ asset('vendor/highchartjs/exporting.js') }}"></script>
    <script src="{{ asset('vendor/highchartjs/export-data.js') }}"></script>
    <script src="{{ asset('vendor/highchartjs/accessibility.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endsection
