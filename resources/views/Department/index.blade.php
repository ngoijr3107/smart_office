@extends('master')

@section('breadcrumb')
    <div class="mr-auto w-p50">
        <h3 class="page-title border-0">Departments</h3>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-6 text-left">
                            <h4 class="box-title">List</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('departmentAdd') }}" class="btn btn-bold btn-pure btn-info">Add department</a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    @if (session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something is wrong:
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped dataTables">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Name</th>
                                    <th class="text-center">Last Update</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if (!is_null($datas) && count($datas) > 0)
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-left text-nowrap">{{ $data->department_name }}</td>
                                            <td class="text-center">
                                                {{ date('M d Y, H:i', strtotime($data->updated_at)) }}
                                            </td>
                                            <td class="text-center">
                                                <span data-toggle="modal" class="btn-view" id="{{ $data->id }}"
                                                    data-purpose="{{ json_encode($data) }}" data-target="#modal-detail">
                                                    <a class="btn btn-sm btn-primary" href="javascript:void(0);"
                                                        data-toggle="tooltip" data-placement="bottom" title="View">
                                                        <i class="ti-eye"></i>
                                                    </a>
                                                </span>
                                                <form action="{{ url('department/' . $data->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure? This record and its details will be permanently deleted!')"
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
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No data available.</td>
                                    </tr>
                                @endif
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
                                    <h4 class="box-title">View Department</h4>
                                </div>
                                <form action="" method="GET" enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($data))
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="department_name">Name</label>
                                                <input type="text" name="department_name" class="form-control"
                                                    value="{{ $data->department_name }}" readonly>
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
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.btn-view').on('click', function() {
            // alert('hello')
            var item = $(this).data('department')
            $('#modal-detail').find('input[name=department_name]').val(item.department_name)
            $('#modal-detail').find('form').attr('action', '/department/edit/' + item.id)
        })

        $(".alert").fadeTo(4000, 500).slideUp(500, function() {
            $(".alert").slideUp(500);
        });
    </script>
@endsection
