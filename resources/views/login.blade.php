<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Department of Sports, Haryana</title>
    <link href="{{ asset('forntend/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="{{ asset('forntend/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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
            padding: 5%;
            background-color: rgba(0, 0, 0, 0.5);
            background-blend-mode: overlay;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }


        .form-container h2 {
            margin-bottom: 1rem;
            color: #404ee8;
            text-align: center;
            font-weight: bold;
        }

        .form-container h5 {

            color: #404ee8;
            font-weight: bold;
            text-align: center;
        }

        .form-container h6 {
            margin-bottom: 1rem;
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

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        #loading-image {
            width: 50px;
            height: 50px;
        }
    </style>
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
        <img id="loading-image" src="{{ asset('forntend/images/loading.gif') }}" alt="Loading...">
    </div>
    <div class="hero-section"
        style="background: url('{{ asset('forntend/images/new-bann.jpeg') }}') no-repeat center center / cover;background-color: rgba(0, 0, 0, 0.5)">

        <div class="form-container">
            <div class="dep-logo">
                <img src="{{ asset('forntend/images/department-logo.png') }}" alt="Department Logo">
            </div>
            <h5>Necessary Proceedings</h5>
            <h6>Necessary Proceedings SYSTEM</h6>

            <h2>Login Page</h2>

            <form>
                @csrf
                <div class="mt-2">
                    <label class="form-label">Enter your mobile number</label>
                    <input type="text" class="form-control" name="phone" id="phone" pattern="[0-9]*"
                        oninput="validateNumber(this)" autocomplete="off" maxlength="10">
                </div>

                <div class="d-flex width-100 mt-2 justify-content-end">
                    <p id="login-button" class="btn btn-danger">Login</p>
                </div>

                <div class="text-center mt-3">
                    {{-- <a href="" style="color: red; font-weight: bold;text-decoration: none;"
                        class="ms-2 w-100">Click
                        here
                        to
                        Apply For Cash Award
                    </a> --}}
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateNumber(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        $(document).ready(function() {
            $('#login-button').on('click', function() {
                // $('.loader').removeClass('d-none');
                $('.invalid-feedback').remove();
                $('input[name="phone"]').removeClass('is-invalid'); 

                $.ajax({
                    url: '{{ url('/login') }}',
                    type: 'POST',
                    data: {
                        phone: $('#phone').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert("Hello !");
                        if (response.status === 'success') {
                           window.location.href = response.redirect_url;
                        //    $('.loader').addClass('d-none');
                        }
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr);
                        if (xhr.status === 422) { 
                            const errors = xhr.responseJSON.message;
                            $('input[name="phone"]').addClass('is-invalid');
                            $('input[name="phone"]').after(`
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>${errors.email}</strong>
                                </span>
                                `);
                                $('.loader').addClass('d-none');
                        } else {
                            $('.loader').addClass('d-none');
                            alert('An unexpected error occurred.');
                        }
                    }
                });
            });
        });

    </script>
</body>

</html>