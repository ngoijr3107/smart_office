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
                                    <th class="text-left text-nowrap">Service rate</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitors as $index => $visitor)
                                    <tr class="">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-left text-nowrap">{{ $visitor->fname }} {{ $visitor->lname }}</td>
                                        <td class="text-left text-nowrap">{{ date('M d Y, H:i', strtotime($visitor->checkintime)) }}</td>
                                        <td class="text-left text-nowrap">
                                            {{ $visitor->department ? $visitor->department->department_name : 'N/A' }}</td>

                                        <td class="text-left text-nowrap">
                                            {{ $visitor->purpose ? $visitor->purpose->purpose_name : 'N/A' }}</td>
                                        @if ($visitor->status == 'in')
                                            <td class="text-left text-nowrap"><span
                                                    class="badge badge-warning">Checked-in</span></td>
                                        @else
                                            <td class="text-left text-nowrap"><span
                                                    class="badge badge-info">Checked-out <br /> {{ date('M d Y, H:i', strtotime($visitor->checkouttime)) }}</span></td>
                                        @endif


                                        @if ($visitor->rate != '' && $visitor->rate == 1)
                                            <td class="text-left text-nowrap"><span class="badge badge-danger">Very
                                                    Bad</span></td>
                                        @elseif($visitor->rate != '' && $visitor->rate == 2)
                                            <td class="text-left text-nowrap"><span class="badge badge-warning">Bad</span>
                                            </td>
                                        @elseif($visitor->rate != '' && $visitor->rate == 3)
                                            <td class="text-left text-nowrap"><span class="badge badge-info">Good</span>
                                            </td>
                                        @elseif($visitor->rate != '' && $visitor->rate == 4)
                                            <td class="text-left text-nowrap"><span class="badge badge-primary">Very
                                                    Good</span></td>
                                        @elseif($visitor->rate != '' && $visitor->rate == 5)
                                            <td class="text-left text-nowrap"><span class="badge badge-success">Excellent
                                                </span></td>
                                        @else
                                        <td class="text-left text-nowrap"><span class="badge badge-secondary">N/A
                                        </span></td>
                                    @endif

                                    <td class="text-center">
                                        <span data-toggle="modal" class="btn-view" id="{{ $visitor->id }}"
                                            data-purpose="{{ json_encode($visitor) }}" data-target="#modal-detail">
                                            <a class="btn btn-sm btn-primary" href="javascript:void(0);"
                                                data-toggle="tooltip" data-placement="bottom" title="View">
                                                <i class="ti-eye"></i>
                                            </a>
                                        </span>
                                        <form action="{{ url('visitor/' . $visitor->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure? This record and its details will be permanantly deleted!')"
                                            class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="ml-3 btn btn-danger" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL HERE --}}
<div class="modal modal-fill fade" data-backdrop="false" id="modal-detail" tabindex="-1" style="z-index: 9999">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" style="padding-right: 28px" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                <h4 class="box-title">View Visitor details</h4>
                            </div>
                            <form method="GET" enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
                                    <div class="row">
                                        @if (isset($visitor))
                                            <div class="form-group col-sm-6">
                                                <label for="fname">First Name</label>
                                                <input type="text" name="fname" class="form-control"
                                                    value="{{ $visitor->fname }}" readonly>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="fname">Last Name</label>
                                                <input type="text" name="lname" class="form-control"
                                                    value="{{ $visitor->lname }}" readonly>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="comment">Comment</label>
                                                <textarea name="comment" class="form-control" readonly>{{ $visitor->comment }}</textarea>
                                            </div>
                                        @endif

                                        {{-- @if (isset($visitor))
                                            <p>First Name: {{ $visitor->fname }}</p>
                                            <p>Last Name: {{ $visitor->lname }}</p>
                                            <p>Comment: {{ $visitor->comment }}</p>
                                           
                                        @endif --}}

                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-3">
                                            <button type="button"
                                                class="btn btn-bold btn-pure btn-secondary btn-block"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                        <div class="col-3">
                                            <button type="submit"
                                                class="btn btn-bold btn-pure btn-info float-right btn-block">Edit</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- </form> --}}
                        </div>
                    </div>
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
