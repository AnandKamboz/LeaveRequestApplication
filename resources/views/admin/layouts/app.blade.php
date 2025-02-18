<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            font-family: sans-serif;
        }

        .sidebar {
            background-color: #f0f0f0;
            padding: 20px;
            height: 100vh;
            overflow-y: auto;
        }

        .content {
            padding: 20px;
        }

        @media (max-width: 767px) {

            .sidebar {
                height: auto;
                overflow-y: visible;
            }

            .row-offcanvas {
                position: relative;
                -webkit-transition: all 0.25s ease-out;
                -moz-transition: all 0.25s ease-out;
                -o-transition: all 0.25s ease-out;
                transition: all 0.25s ease-out;
            }

            .row-offcanvas.active {
                left: 250px;
            }

            .sidebar-offcanvas {
                position: absolute;
                top: 0;
                left: -250px;
                width: 250px;
                background-color: #f0f0f0;
                -webkit-transition: all 0.25s ease-out;
                -moz-transition: all 0.25s ease-out;
                -o-transition: all 0.25s ease-out;
                transition: all 0.25s ease-out;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#sidebar-collapse" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Your Brand</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="col-sm-3 col-xs-6 sidebar sidebar-offcanvas" id="sidebar-collapse" role="navigation">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#">Dashboard</a></li>
                    <li><a href="#">Applications</a></li>
                    <li><a href="#">Download Report</a></li>
                    <li><a href="#">User</a></li>
                    <li><a href="#">DSO Transfer History</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-xs-12 content">
                <p class="visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </p>
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').click(function() {
                $('.row-offcanvas').toggleClass('active');
            });
        });
    </script>

</body>

</html>