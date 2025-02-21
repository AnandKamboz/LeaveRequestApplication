<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin/adminlayout/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.15.10/sweetalert2.css"
        integrity="sha512-aT8kGTpksA05BegcQmkwCB142bJ9VHx8RAdt4FsCxivASGHCKrI3o1KX5oftKK8J8oZ5v450UtJPp66EJhEuHA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

<body>
    <div class="d-flex">
        <div class="sidebar animate_animated animate_fadeInLeft " id="sidebar">
            <div class="d-flex justify-content-center align-items-center">
                <div class="profile-card">
                    <div class="profile-header"></div>
                    <img src="{{ asset('/images/image.png') }}" alt="Profile Picture" class="rounded-circle profile-img"
                        width="80" height="80">
                    <p class="profile-name">{{ ucfirst(Auth::user()->name) }}</p>
                    <p class="profile-text">Department of NP, Haryana Government</p>
                    <p class="profile-text">सहारनपुर, उत्तर प्रदेश</p>
                    <p class="profile-badge"><span>Department of NP</span></p>
                    <p class="profile-badge"><span>Government of Haryana</span></p>
                </div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item p-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link text-white nav-item nav-link {{ Request::is('admin/dashboard') || Request::is('admin/dashboard') ? 'active' : '' }}">Dashboard</a>
                </li>
                <li class="nav-item p-2">
                    <a href="{{ route('admin.employees.index') }}"
                        class="nav-link text-white {{ Request::is('admin/employees') || Request::is('admin/employees/create') ? 'active' : '' }}">Leave
                        Management
                    </a>
                </li>
                <li class="nav-item p-2">
                    <a href="{{ route('admin.user.create') }}" class="nav-link text-white">Add User</a>
                </li>

                <li class="nav-item p-2">
                    <a href="{{ route('admin.company-names.create') }}" class="nav-link text-white">Add Company Name</a>
                </li>
            </ul>
        </div>

        <div class="content w-100 animate_animated animate_fadeInRight" id="content">
            <div class="container">
                <div class="mb-2 fledx-wrap">
                    <button class="toggle-btn" id="toggleSidebar">☰</button>
                    <button class="logout-btn" id="logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>

                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.15.10/sweetalert2.min.js"
        integrity="sha512-M60HsJC4M4A8pgBOj7oC/lvJXuOc9CraWXdD4PF+KNmKl8/Mnz6AH9FANgi4SJM6D9rqPvgQt4KRFR1rPN+EUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/admin/adminlayout/app.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
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
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            confirmButtonText: 'OK',
        });
    </script>
    @endif

</body>

</html>