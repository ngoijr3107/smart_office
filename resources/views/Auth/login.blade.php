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
    {{-- <body class="hold-transition bg-img" style="background: url(https://images.unsplash.com/photo-1497366811353-6870744d04b2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2250&q=80) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;" data-overlay="1"> --}}
    <body class="hold-transition bg-img" style="background: url('{{ asset('/img/bg-ds.jpeg') }}') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;" data-overlay="1">
        <div class="container-fluid h-p100">
            <div class="row align-items-center justify-content-md-center h-p100">
                <div class="col-12">
                    <div class="row no-gutters">
                        <div class="col-lg-8 col-md-5 col-12"></div>
                        <div class="col-lg-4 col-md-7 col-12 xtd">
                            {{-- <h2 class="text-center">Welcome to VMS</h2> --}}
                            <div class="p-30 content-bottom rounded bg-img box-shadowed" style="background: rgba(255, 255, 255, .7)">
                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <img src="{{ asset('/img/logo.png') }}" alt="" style="height: 100px">
                                    </div>
                                </div>
                                <div class="mb-4 pt-4">
                                    {{-- <h4 class="text-dark font-size-30">Get Started<br>with your Dashboard</h4> --}}
                                    <h4 class="text-dark">Sign in to your account</h4>
                                </div>
                                <form action="{{ route('login') }}" method="POST">
                                @csrf
                                    @if(session('errors'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Something went wrong:
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
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent bt-0 bl-0 br-0 no-radius text-dark border-radius-0"><i class="ti-email"></i></span>
                                            </div>
                                            <input type="text" class="form-control pl-15 bg-transparent bt-0 bl-0 br-0 text-dark border-radius-0" placeholder="Email address" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text  bg-transparent bt-0 bl-0 br-0 text-dark border-radius-0"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control pl-15 bg-transparent bt-0 bl-0 br-0 text-dark border-radius-0" placeholder="Password" name="password">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-3 pt-3">
                                            <div class="fog-pwd text-left">
                                                <a href="{{ route('forgot') }}" class="text-dark hover-info">
                                                    <i class="ion ion-locked"></i> Forgot Password?
                                                </a>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center mt-4 mb-4">
                                            <button type="submit" class="btn btn-success btn-block margin-top-10">SIGN IN</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                                {{-- <div class="pt-4">
                                    {{-- <h4 class="text-dark font-size-30">Get Started<br>with your Dashboard</h4>
                                    <h5 class="text-dark mb-0">need support? <a href="mailto:vms@techvilla.co.tz?subject=Need support smart office" class="text-info">vms@techvilla.co.tz</a></h5>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery 3 -->
        <script src="{{ asset('vendor/jquery-3.3.1/jquery-3.3.1.js') }}"></script>
        <script src="{{ asset('vendor/popper/popper.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/bootstrap.js') }}"></script>

    </body>
</html>
