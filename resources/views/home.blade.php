<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('/img/favicon.jpg') }}">
    <title>Smart Office</title>
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.css') }}">
    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-extend.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/master_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/_all-skins.css') }}">
    <link rel="stylesheet" href="{{ asset('css/meus.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="hold-transition bg-img"
    style="background: url(https://images.unsplash.com/photo-1497366811353-6870744d04b2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2250&q=80) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;"
    data-overlay="1">

    <body class="hold-transition bg-img"
        style="background: url('{{ asset('/img/bg_login.jpg') }}') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;"
        data-overlay="1">
        <div class="container-fluid h-p100">
            <div class="row align-items-center justify-content-md-center h-p100">
                <div class="col-12">
                    <div class="row no-gutters">
                        {{-- <div class="col-lg-8 col-md-7 col-12"></div> --}}
                        <div class="col-lg-5 col-md-7 col-12 xtd">
                            {{-- <h2 class="text-center text-white text-bold">Welcome to VMS</h2> --}}
                            <div class="p-30 content-bottom rounded bg-img box-shadowed"
                                style="background: rgba(255, 255, 255, .9)">
                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <img src="{{ asset('/img/logo_web.png') }}" alt="" style="height: 50px">
                                        <h2 class="text-center">Welcome, Please tap on button below to proceed</h2>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-6 text-center mb-4">
                                        <a href="{{ url('checkOut') }}"
                                            class="btn btn-danger btn-block p-20 fs-3 text-bold btn-lg margin-top-10"><i
                                                class="ti-angle-double-left"></i> CHECK-OUT</a>
                                    </div>
                                    <div class="col-6 text-center mb-4">
                                        <a href="{{ url('check_in') }}"
                                            class="btn btn-success btn-block p-20 fs-3 text-bold btn-lg margin-top-10">CHECK-IN
                                            <i class="ti-angle-double-right"></i></a>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    {{-- <h4 class="text-dark font-size-30">Get Started<br>with your Dashboard</h4> --}}
                                    <h5 class="text-dark text-center mb-0">&copy; {{ date('Y') }}, All Rights
                                        Reserved. <a href="https://techvilla.co.tz" class="text-info">Techvilla.</a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
        <!-- jQuery 3 -->
        <script src="{{ asset('vendor/jquery-3.3.1/jquery-3.3.1.js') }}"></script>
        <script src="{{ asset('vendor/popper/popper.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/bootstrap.js') }}"></script>

    </body>

</html>
