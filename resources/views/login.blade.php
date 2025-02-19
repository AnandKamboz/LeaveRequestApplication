<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Necessary Proceedings | Haryana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
</head>

@if ($message = Session::get('msg'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
            Swal.fire(
                'Cash Award Management System'
                , '{{ $message }}'
                , 'success'
            );
        });

</script>
@endif


<body>
    <div class="loader d-none">
        <img id="loading-image" src="{{ asset('images/loader/loader.gif') }}" alt="Loading...">
    </div>
    <div class="hero-section"
        style="background: url('{{ asset('images/loginbackgroundimage/login-bg.jpg') }}') no-repeat center center / cover;background-color: rgba(0, 0, 0, 0.5)">

        <div class="form-container">
            <div class="dep-logo">
                <img src="{{ asset('images/loginbackgroundimage/department-logo.png') }}" alt="Department Logo">
            </div>
            <h5>Necessary Proceedings</h5>
            <h6>Necessary Proceedings SYSTEM</h6>
            <h2>Login Page</h2>

            <form>
                @csrf
                <div class="mt-2">
                    <label class="form-label">
                        Enter your mobile number <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="phone" id="phone" pattern="[0-9]*"
                        oninput="validateNumber(this)" autocomplete="off" maxlength="10">
                </div>

                <div class="d-flex width-100 mt-2 justify-content-end">
                    <p id="login-button" class="btn btn-danger">Login</p>
                </div>
            </form>
        </div>
    </div>

    <script>
        var BASE_URL = "{{ url('') }}";
    </script>
    <script src="{{ asset('js/login/login.js') }}"></script>
</body>

</html>