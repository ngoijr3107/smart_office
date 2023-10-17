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
                        <div class="col-lg-8 col-md-7 col-12"></div>
                        <div class="col-lg-6 col-md-5 col-12 xtd">

                            <div class="p-30 content-bottom rounded bg-img box-shadowed"
                                style="background: rgba(255, 255, 255, .9)">
                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <img src="{{ asset('/img/logo_web.png') }}" alt=""
                                            style="height: 60px; margin-bottom: 12px">
                                        {{-- <hr> --}}
                                        <h3 class="text-center text-bold">Hi {{ $visitor->fname }},</h3>
                                        <h5 class="text-center">Please click
                                            Check-Out button to confirm</h5>
                                        {{-- <h3 class="text-center">Please find your name and then Check-out</h3> --}}
                                        <hr>
                                    </div>
                                </div>

                                <form action="{{ url('checkOutConfirm', ['visitor' => $visitor->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="checkouttime">Check-out time</label>
                                            <div class="input-group mb-3">
                                                <input type="text"
                                                    class="form-control pl-15 bg-transparent bt-0 bl-0 br-0 text-dark border-radius-0"
                                                    placeholder="Time to check-out" id="checkout-time"
                                                    name="checkouttime">
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        {{-- radio inputs --}}
                                        <div class="col-12 form-group">
                                            <h5>Please let us know, how did you find our service?</h5>
                                        </div>
                                        <div class="col-12 form-group">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="inlineRadio1">Very
                                                    bad</label>&nbsp;
                                                <input class="form-check-input" type="radio" name="rate"
                                                    id="inlineRadio1" value="1">
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="inlineRadio2">Bad</label>&nbsp;
                                                <input class="form-check-input" type="radio" name="rate"
                                                    id="inlineRadio2" value="2">
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="inlineRadio3">Good</label>&nbsp;
                                                <input class="form-check-input" type="radio" name="rate"
                                                    id="inlineRadio3" value="3">
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="inlineRadio3">Very
                                                    Good</label>&nbsp;
                                                <input class="form-check-input" type="radio" name="rate"
                                                    id="inlineRadio3" value="4">
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"
                                                    for="inlineRadio3">Excellent</label>&nbsp;
                                                <input class="form-check-input" type="radio" name="rate"
                                                    id="inlineRadio3" value="5">
                                            </div>
                                        </div>

                                        {{-- radio inputs --}}

                                        <div class="col-12 form-group">
                                            <label for="comment">Comment</label>
                                            <div class="input-group mb-3">
                                                <textarea type="text" class="form-control pl-15 bg-transparent bt-0 bl-0 br-0 text-dark border-radius-0"
                                                    placeholder="Please tell us your Opinions/Suggestions/Complaints...." id="comment" value=""
                                                    name="comment"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 text-center mt-4 mb-4">
                                            <a style="color: #fff" id="previous-button"
                                                class="btn btn-danger btn-block margin-top-10">PREVIOUS</a>
                                        </div>
                                        <div class="col-6 text-center mt-4 mb-4">
                                            <button type="submit"
                                                class="btn btn-success btn-block margin-top-10">CHECKOUT</button>
                                        </div>
                                    </div>
                                </form>
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

        <script>
            const previousButton = document.querySelector('#previous-button');
            const datetimeField = document.querySelector('#checkout-time');

            previousButton.addEventListener('click', () => {
                history.back();
            });

            setInterval(() => {
                const now = new Date();
                datetimeField.value = now.toISOString().slice(0, 19).replace('T', ' ');
            }, 1000);
        </script>


    </body>

</html>
