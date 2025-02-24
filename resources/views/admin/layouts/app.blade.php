<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin/adminlayout/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.15.10/sweetalert2.css"
        integrity="sha512-aT8kGTpksA05BegcQmkwCB142bJ9VHx8RAdt4FsCxivASGHCKrI3o1KX5oftKK8J8oZ5v450UtJPp66EJhEuHA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css"
        integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .my-div {
            height: 45vh;
            overflow-y: auto;
        }
    </style>

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

            <div class="my-div">
                <ul class="nav flex-column">
                    <li class="nav-item p-2">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link text-white nav-item nav-link {{ Request::is('admin/dashboard') || Request::is('admin/dashboard') ? 'active' : '' }}">Dashboard</a>
                    </li>

                    <li class="nav-item p-2">
                        <a href="#leaveMenu"
                            class="nav-link text-white d-flex justify-content-between align-items-center 
                            {{ Request::is('admin/leave-applications') || Request::is('admin/leave-applications/*') ? 'active' : '' }}"
                            data-bs-toggle="collapse"
                            aria-expanded="{{ Request::is('admin/leave-applications') || Request::is('admin/leave-applications/*') ? 'true' : 'false' }}">
                            Leave Management <i class="fas fa-chevron-left ms-1"></i>
                        </a>
                        <ul id="leaveMenu"
                            class="collapse list-unstyled ms-3 {{ Request::is('admin/leave-applications') || Request::is('admin/leave-applications/*') ? 'show' : '' }}">

                            <li class="nav-item p-2">
                                <a href="{{ route('admin.leave-applications.create') }}"
                                    class="nav-link text-white {{ Request::is('admin/leave-applications/create') ? 'active' : '' }}">
                                    Add Leave
                                </a>
                            </li>

                            <li class="nav-item p-2">
                                <a href="{{ route('admin.leave-applications.index') }}"
                                    class="nav-link text-white 
                                    {{ Request::is('admin/leave-applications') || (Request::is('admin/leave-applications/*') && !Request::is('admin/leave-applications/create')) ? 'active' : '' }}">
                                    View Leave Applications
                                </a>
                            </li>
                        </ul>
                    </li>

                    <script></script>

                    <li class="nav-item p-2">
                        <a href="#employeeMenu" class="nav-link text-white d-flex justify-content-between align-items-center 
                           {{ Request::is('admin/user*') ? 'active' : '' }}" data-bs-toggle="collapse"
                            aria-expanded="{{ Request::is('admin/user*') ? 'true' : 'false' }}">
                            Employee Management <i class="fas fa-chevron-left ms-1"></i>
                        </a>
                        <ul id="employeeMenu"
                            class="collapse list-unstyled ms-3 {{ Request::is('admin/user*') ? 'show' : '' }}">

                            <li class="nav-item p-2">
                                <a href="{{ route('admin.user.create') }}"
                                    class="nav-link text-white {{ Request::is('admin/user/create') ? 'active' : '' }}">
                                    Add Employee
                                </a>
                            </li>

                            <li class="nav-item p-2">
                                <a href="{{ route('admin.user.index') }}"
                                    class="nav-link text-white {{ Request::is('admin/user') || (Request::is('admin/user/*') && !Request::is('admin/user/create')) ? 'active' : '' }}">
                                    View Employees
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-item p-2">
                        <a href="#companyMenu" class="nav-link text-white d-flex justify-content-between align-items-center 
                            {{ Request::is('admin/company-names*') ? 'active' : '' }}" data-bs-toggle="collapse"
                            aria-expanded="{{ Request::is('admin/company-names*') ? 'true' : 'false' }}">
                            Company Name <i class="fas fa-chevron-left ms-1"></i>
                        </a>
                        <ul id="companyMenu"
                            class="collapse list-unstyled ms-3 {{ Request::is('admin/company-names*') ? 'show' : '' }}">

                            <li class="nav-item p-2">
                                <a href="{{ route('admin.company-names.create') }}"
                                    class="nav-link text-white {{ Request::is('admin/company-names/create') ? 'active' : '' }}">
                                    Add Company Name
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a href="{{ route('admin.company-names.index') }}"
                                    class="nav-link text-white {{ Request::is('admin/company-names') || (Request::is('admin/company-names/*') && !Request::is('admin/company-names/create')) ? 'active' : '' }}">
                                    View Company Names
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-item p-2">
                        <a href="#leaveTypeMenu" class="nav-link text-white d-flex justify-content-between align-items-center 
                            {{ Request::is('admin/leave-types*') ? 'active' : '' }}" data-bs-toggle="collapse"
                            aria-expanded="{{ Request::is('admin/leave-types*') ? 'true' : 'false' }}">
                            Leave Type Management <i class="fas fa-chevron-left ms-1"></i>
                        </a>
                        <ul id="leaveTypeMenu"
                            class="collapse list-unstyled ms-3 {{ Request::is('admin/leave-types*') ? 'show' : '' }}">

                            <li class="nav-item p-2">
                                <a href="{{ route('admin.leave-types.create') }}"
                                    class="nav-link text-white {{ Request::is('admin/leave-types/create') ? 'active' : '' }}">
                                    Add Leave Type
                                </a>
                            </li>

                            <li class="nav-item p-2">
                                <a href="{{ route('admin.leave-types.index') }}"
                                    class="nav-link text-white {{ Request::is('admin/leave-types') || (Request::is('admin/leave-types/*') && !Request::is('admin/leave-types/create')) ? 'active' : '' }}">
                                    View Leave Types
                                </a>
                            </li>
                        </ul>
                    </li>
                    <script></script>
                </ul>

            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    @if (session('msg'))
    <script>
        Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('msg') }}",
                confirmButtonText: 'OK',
            });

            document.addEventListener("DOMContentLoaded", function() {
                var menuToggle = document.querySelector('[href="#leaveMenu"]');
                var icon = menuToggle.querySelector("i");
                var menu = document.getElementById("leaveMenu");

                function updateIcon() {
                    if (menu.classList.contains("show")) {
                        icon.classList.replace("fa-chevron-left", "fa-chevron-down");
                    } else {
                        icon.classList.replace("fa-chevron-down", "fa-chevron-left");
                    }
                }

                updateIcon();

                menu.addEventListener("shown.bs.collapse", updateIcon);
                menu.addEventListener("hidden.bs.collapse", updateIcon);
            });
            document.addEventListener("DOMContentLoaded", function() {
                function setupMenuToggle(menuId, menuToggleSelector) {
                    var menuToggle = document.querySelector(menuToggleSelector);
                    if (!menuToggle) return;
                    var icon = menuToggle.querySelector("i");
                    var menu = document.getElementById(menuId);

                    function updateIcon() {
                        if (menu.classList.contains("show")) {
                            icon.classList.replace("fa-chevron-left", "fa-chevron-down");
                        } else {
                            icon.classList.replace("fa-chevron-down", "fa-chevron-left");
                        }
                    }

                    menu.addEventListener("shown.bs.collapse", updateIcon);
                    menu.addEventListener("hidden.bs.collapse", updateIcon);
                }

                setupMenuToggle("employeeMenu", '[href="#employeeMenu"]');
            });
            document.addEventListener("DOMContentLoaded", function() {
                function setupMenuToggle(menuId, menuToggleSelector) {
                    var menuToggle = document.querySelector(menuToggleSelector);
                    if (!menuToggle) return;
                    var icon = menuToggle.querySelector("i");
                    var menu = document.getElementById(menuId);

                    function updateIcon() {
                        if (menu.classList.contains("show")) {
                            icon.classList.replace("fa-chevron-left", "fa-chevron-down");
                        } else {
                            icon.classList.replace("fa-chevron-down", "fa-chevron-left");
                        }
                    }

                    menu.addEventListener("shown.bs.collapse", updateIcon);
                    menu.addEventListener("hidden.bs.collapse", updateIcon);
                }

                setupMenuToggle("companyMenu", '[href="#companyMenu"]');
            });
            document.addEventListener("DOMContentLoaded", function() {
                function setupMenuToggle(menuId, menuToggleSelector) {
                    var menuToggle = document.querySelector(menuToggleSelector);
                    if (!menuToggle) return;
                    var icon = menuToggle.querySelector("i");
                    var menu = document.getElementById(menuId);

                    function updateIcon() {
                        if (menu.classList.contains("show")) {
                            icon.classList.replace("fa-chevron-left", "fa-chevron-down");
                        } else {
                            icon.classList.replace("fa-chevron-down", "fa-chevron-left");
                        }
                    }

                    menu.addEventListener("shown.bs.collapse", updateIcon);
                    menu.addEventListener("hidden.bs.collapse", updateIcon);
                }

                setupMenuToggle("leaveTypeMenu", '[href="#leaveTypeMenu"]');
            });
    </script>
    @endif

</body>

</html>