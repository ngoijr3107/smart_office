@extends('master')

@section('breadcrumb')
    <div class="mr-auto w-p50">
        <h3 class="page-title border-0">Vistor Management</h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                {{-- <div class="box-header">
                    <div class="row">
                        <div class="col-6 text-left">
                            <h4 class="box-title">List Visitor</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('spc.index') }}" target="_blank"
                                class="btn btn-bold btn-pure btn-info">Special Visitor</a>
                        </div>
                    </div>
                </div> --}}
                <div class="box-body">
                    <div class="mb-4">
                        <div class="form-inline">
                            <div class="form-group">
                                <input type="date" class="form-control form-control-sm" name="t0" id="t0"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                To
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control form-control-sm" name="t1" id="t1"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr class="">
                                    <th class="text-center">#</th>
                                    <th class="text-left text-nowrap">Name</th>
                                    <th class="text-left text-nowrap">Check-in time</th>
                                    <th class="text-left text-nowrap">Department</th>
                                    <th class="text-left text-nowrap">Visit Purpose</th>
                                    <th class="text-left text-nowrap">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitors as $index => $visitor)
                                    <tr class="">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-left text-nowrap">{{ $visitor->fname }} {{ $visitor->lname }}</td>
                                        <td class="text-left text-nowrap">{{ $visitor->checkintime }}</td>
                                        <td class="text-left text-nowrap">{{ $visitor->department }}</td>
                                        <td class="text-left text-nowrap">{{ $visitor->purpose }}</td>
                                        @if ($visitor->status == 'in')
                                            <td class="text-left text-nowrap"><span
                                                    class="badge badge-warning">Checked-in</span></td>
                                        @else
                                            <td class="text-left text-nowrap"><span
                                                    class="badge badge-info">Checked-out</span></td>
                                        @endif
                                        <td class="text-center">Action</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('script')
    <script>
        $('#dataTable').DataTable();
    </script>
@endsection
