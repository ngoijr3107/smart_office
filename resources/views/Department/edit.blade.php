@extends('master')

@section('breadcrumb')
    <div class="mr-auto w-p50">
        <h3 class="page-title border-0">Edit Department</h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">Department</h4>
                </div>
                <form action="{{ url('department/update/'.$department->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="box-body">
                        @if(session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Something it's wrong:
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
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="department_name" class="form-control" value="{{$department->department_name}}" placeholder="">
                        </div>

                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-3">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary btn-block" onclick="window.location.href='{{route('department')}}'">Cancel</button>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-bold btn-pure btn-info float-right btn-block">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

