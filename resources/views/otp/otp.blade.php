<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sports Department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="{{ asset('css/otp/otp.css') }}">
</head>

<body>
    <section class="hero-section"
        style="background: url('{{ asset('images/loginbackgroundimage/login-bg.jpg') }}') no-repeat center center / cover;background-color: rgba(0, 0, 0, 0.5)">
        <div class="form-container">

            <div class="dep-logo">
                <img src="{{ asset('images/loginbackgroundimage/department-logo.png') }}" alt="Department Logo">
            </div>
            <h5 class="management-new">Department of Necessary Proceedings</h5>
            <h6 class="CASH-AWARD">Necessary Proceedings MANAGEMENT SYSTEM</h6>
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
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "timeOut": "5000"
            };

            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif

            @if (session('info'))
                toastr.info("{{ session('info') }}");
            @endif

            @if (session('warning'))
                toastr.warning("{{ session('warning') }}");
            @endif
        });
    </script>
    <script src="{{ asset('js/login/login.js') }}"></script>
</body>

</html>