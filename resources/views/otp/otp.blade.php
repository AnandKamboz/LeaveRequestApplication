<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sports Department</title>

    <link href="{{ url('public/forntend') }}/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">



    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            /* Prevent scrolling */
        }


        .hero-section {
            height: 100%;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 5%;
            background-color: rgba(0, 0, 0, 0.5);
            background-blend-mode: overlay;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 1rem;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
        }


        .management-new {
            margin-bottom: .6rem;
            margin-top: 0;
            color: #404ee8;
            font-size: 1.25rem;
            text-align: center;
            font-weight: bold;
        }

        .management-new-2 {

            margin-bottom: .5rem;
            font-size: 1.7rem;
            color: #404ee8;
            text-align: center;
            font-weight: bold;
        }


        .CASH-AWARD {
            margin: 0;
            font-size: 1.25rem;
            color: #2f2f2f;
            text-align: center;
        }

        .btn-custom {
            background-color: #ef3b3b;
            color: #fff;
            margin-bottom: 1rem;
        }

        .btn-custom:hover {
            background-color: #c12a2a;
        }

        .form-footer {
            text-align: center;
            margin-top: 1rem;
        }

        .form-footer a {
            color: #404ee8;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .dep-logo {

            text-align: center;
        }

        .dep-logo img {
            width: 120px;
            margin-bottom: 5px;
            text-align: center;
        }

        @media (max-width: 768px) {

            .hero-section {

                padding: 5%;

            }

            .h2,
            h2 {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>


    {{-- --------------new------------------- --}}

    {{-- --------------new---------------- --}}

    <section class="hero-section"
        style="background: url('{{ asset('forntend/images/new-bann.jpeg') }}') no-repeat center center / cover;background-color: rgba(0, 0, 0, 0.5)">



        <div class="form-container">




            <div class="dep-logo">
                <img src="{{ asset('forntend/images/department-logo.png') }}" alt="Department Logo">

            </div>
            {{-- <h1 class="text-white mt-3  management-new">Department of Sports Haryana <span class="CASH-AWARD">CASH
                    AWARD
                    MANAGEMENT
                    SYSTEM</span></h1> --}}

            <h5 class="management-new">Department of Sports Haryana</h5>
            <h6 class="CASH-AWARD">CASH AWARDS MANAGEMENT SYSTEM</h6>
            <div class="">
                <h1 class="management-new-2">Login Page</h1>

                <form action="{{ url('login/otp/verify/') . '/' . $token }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h2 class=" mt-1" style="font-size: 18px!important"> {{ $msg }}</h2>
                        </div>
                    </div>

                    <div class="mt-1">

                        <label class="form-label ">Enter your OTP</label>
                        <input type="password" pattern="[0-9]+" maxlength="6" class="form-control" name="otp">

                        @error('otp')
                        <span class="invalid-feedback" role="alert" style="display : block;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    {{-- Captch Code --}}


                    <div class="mt-1">
                        <label class="form-label">Captcha Code</label>
                        <input type="text" name="captcha_input" class="form-control mt-1"
                            placeholder="Enter Captcha Code">

                        <div class=" mt-1 captcha-code text-white bg-dark p-2 rounded text-center"
                            style="user-select: none; -webkit-user-select: none; -ms-user-select: none;">
                            <strong>{{ session('captcha_code') }}</strong>
                        </div>

                        @if ($errors->has('captcha_input'))
                        <div class="text-danger mt-1">
                            {{ $errors->first('captcha_input') }}
                        </div>
                        @endif
                    </div>






                    <div class="d-flex width-100 mt-1 justify-content-end">
                        <a class="btn btn-danger mr-2 ml-2"
                            href="{{ url('login/otp/resendotp') . '/' . $token }}">Resend OTP</a>
                        &nbsp;
                        &nbsp;
                        <button type="submit" class="btn btn-danger ">Verify OTP</button>

                    </div>
                    <div class="text-center">
                    </div>
                </form>
            </div>




        </div>

    </section>

    <script src="{{ url('public/forntend/') }}/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href='{{ asset(' forntend/css/theme.css') }}'>
    <script src="{{ asset('assets/plugins/jquery') }}/jquery.min.js"></script>





    @if ($message = Session::get('success'))
    <script>
        $(document).ready(function() {
                Swal.fire(
                    'CASH AWARD MANAGEMENT SYSTEM',
                    '{{ $message }}',
                    'success'
                )
            });
    </script>
    @endif

    @if ($message = Session::get('error'))
    <script>
        $(document).ready(function() {
                Swal.fire(
                    'CASH AWARD MANAGEMENT SYSTEM',
                    '{{ $message }}',
                    'error'
                )

            });
    </script>
    @endif

</body>

</html>