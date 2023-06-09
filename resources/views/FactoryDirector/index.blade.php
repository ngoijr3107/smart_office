@extends('master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('breadcrumb')
    <div class="mr-auto w-p50">
        <h3 class="page-title border-0">Factory Director</h3>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-6 text-left">
                            {{-- <h4 class="box-title">Attendance ({{$monthName}}, {{$year}})</h4> --}}
                            <h4 class="box-title">List Visitor</h4>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    {{-- <div class="box-header"> --}}
                        <div class="row">
                            {{-- <div class="col-sm-12 text-left">
                                <h4 class="box-title mb-4">My Attendance</h4>
                            </div> --}}
                            <div class="col-sm-10 text-left">
                                <form action="" method="GET" class="form-inline">
                                    <div class="form-group">
                                        <input type="date" class="form-control form-control-sm" name="start_date" value="{{ date('Y-m-d')}}">
                                    </div>
                                    <div class="form-group">
                                        To
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control form-control-sm" name="end_date" value="{{ date('Y-m-d')}}">
                                    </div>
                                    <button type="submit" class="btn btn-bold btn-pure btn-info">Filter</button>
                                </form>
                            </div>
                        </div><br>
                    {{-- </div> --}}
                    {{-- <div class="flash-message"></div> --}}
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
                    <div class="table-responsive-lg dataTables_scroll">
                        <table id="data-tables" class="table table-striped table-bordered " style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-wrap">Date From</th>
                                <th class="text-wrap">Time</th>
                                <th class="text-wrap">Visitor ID</th>
                                <th class="text-wrap">Project Detail</th>
                                <th class="text-wrap">Work Area</th>
                                <th class="text-wrap text-center">Number Worker</th>
                                <th class="text-wrap text-center">Findings</th>
                                <th class="text-wrap text-center">Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="confirm-delete" class="modal fade"  data-backdrop="false" tabindex="-1" style="z-index: 9999">
        <div class="modal-dialog modal-confirm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row col-12">
                        <div class="col-12">
                            <div class="icon-box">
                                <i class="material-icons center">&#xE5CD;</i>
                            </div>
                        </div>
                        <div class="col-12">
                            <h4 class="modal-title">Are you sure?</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Do you really want to approve these project?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src='https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js'></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');
        var xyz = $('#data-tables').DataTable({
                processing: true,
                serverSide: true,
                "autoWidth": false,
                "responsive": true,
                "order": [[ 1, 'asc' ]],
                ajax: "{{route('getAllFactoryDirector')}}",
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    var info = $(this).DataTable().page.info();
                    $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
                    return nRow;
                },
                columnDefs: [
                    {
                        targets: [6,7],
                        className : "text-center",
                    },
                    {  targets: 1,
                        render: function (data, type, row, meta) {
                            if(data.date_start == data.date_end){
                                return moment(data.date_start).format('MMM D, YYYY');
                            } else {
                                return moment(data.date_start).format('MMM D, YYYY') +" - " +moment(data.date_end).format('MMM D, YYYY');
                            }
                        },
                    },
                    {  targets: 2,
                        render: function (data, type, row, meta) {
                            return moment(data.time_start).format('HH:mm') +"-" +moment(data.time_end).format('HH:mm');
                        },
                    },
                    {  targets: 3,
                        render: function (data, type, row, meta) {
                            // console.log(row)
                            let x = ('0000' + data).slice(-4);
                            if (row.type.type == 1){
                                let a = `VSN${x}`
                                return a;
                            } else {
                                let a = `VS${x}`
                                return a;
                            }
                        },
                    },
                    {  targets: 5,
                        render: function (data, type, row, meta) {
                            let display = "";
                            if(data.length > 0){

                                for(let i = 0 ; i < data.length; i++){
                                    display = display.concat(data[i].area.name+"; ")
                                }
                            }else{
                                display = "-"
                            }

                            return display
                        },
                    },
                    {  targets: 8,
                        render: function (data, type, row, meta) {
                            return '<button id=d-"' + data + '" class="ml-3 btn-action btn-view" data-toggle="tooltip" data-placement="bottom" title="View">'+
                                '<i class="ti-eye"></i>'+
                                '</button>'+
                                '<button id=d-"' + data + '" class="ml-3 btn-action btn-check" data-toggle="tooltip" data-placement="bottom" title="Approve">'+
                                '<i class="ti-check"></i>'+
                                '</button>';
                            // if(data.status === 6){
                            //     return '<button id=d-"' + data + '" class="ml-3 btn-action btn-view" data-toggle="tooltip" data-placement="bottom" title="View">'+
                            //         '<i class="ti-eye"></i>'+
                            //         '</button>'+
                            //         '<button id=d-"' + data + '" class="ml-3 btn-action btn-check" data-toggle="tooltip" data-placement="bottom" title="Approve">'+
                            //         '<i class="ti-check"></i>'+
                            //         '</button>';
                            // }else{
                            //     return '<button id=d-"' + data + '" class="ml-3 btn-action btn-view" data-toggle="tooltip" data-placement="bottom" title="View">'+
                            //         '<i class="ti-eye"></i>'+
                            //         '</button>';
                            // }
                        }
                    }
                ],
                columns: [

                    { data: null,"sortable": false  },
                    { data: 'date',"sortable": false },
                    { data: 'time',"sortable": false },
                    { data: 'id_company',"sortable": false },
                    { data: 'project_detail',"sortable": false },
                    { data: 'location_visit',"sortable": false },
                    { data: 'number_worker',"sortable": false },
                    { data: 'findings',"sortable": false },
                    { data: 'id',"sortable": false  }
                ]
            });
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        function triggerSwal(id){
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you want to approve this project ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "factory-director/approve/"+id,
                        type: 'post',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data.result)
                            if(data.result == true){
                                swalWithBootstrapButtons.fire(
                                    'Finish Project!',
                                    'Project has been finish.',
                                    'success'
                                )
                            }else{
                                swalWithBootstrapButtons.fire(
                                    'Finish Failed!',
                                    'Cancel finish project.',
                                    'error'
                                );
                            }
                        }
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        $('#data-tables').DataTable().ajax.reload(null, false);
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'You cancel this project finish ',
                        'error'
                    )
                }
            });
        }
        $('#data-tables').on('click', 'button.btn-check', function () {
            let id = $(this).attr("id").match(/\d+/)[0];
            triggerSwal(id);
        });
        $('#data-tables').on('click', 'button.btn-view', function () {
            let id = $(this).attr("id").match(/\d+/)[0];
            window.location.href = "factory-director-project-get/"+id;
        });
    </script>
@endsection

