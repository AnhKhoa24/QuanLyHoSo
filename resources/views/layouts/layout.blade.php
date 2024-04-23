<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        @if (isset($title))
            {{ $title }}
        @endif
    </title>

    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon"
        href="https://scontent.fsgn17-1.fna.fbcdn.net/v/t39.30808-1/312455376_1252545965319890_9105224374554298734_n.jpg?stp=dst-jpg_s320x320&_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_ohc=7Glgta8hd1cAb6ITUbh&_nc_ht=scontent.fsgn17-1.fna&oh=00_AfCSB9zrZro21bvuSsCBOpoIZk3mMMKjRVfDdd0MxSlsGQ&oe=662141CB" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    {{-- SELECT2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <svg width="100" height="100" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#FFD700" d="M12 2.63l2.37 7.29h7.62l-6.18 4.5 2.37 7.29-6.21-4.53-6.21 4.53 2.37-7.29-6.18-4.5h7.62z"/>
                              </svg>
                              
                        </span>
                                            
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">VieHoso</span>
                    </a>

                    <a href="#" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item">
                        <a href="/" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Trang chủ</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Trang</span>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-dock-top"></i>
                            <div data-i18n="Account Settings">Quản lý</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('phongban') }}" class="menu-link">
                                    <div>Phòng ban</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('nhanvien') }}" class="menu-link">
                                    <div>Nhân viên</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('hoso') }}" class="menu-link">
                                    <div>Hồ sơ</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('congviec') }}"  class="menu-link">
                                    <div>Công việc</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            {{-- <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none"
                                    placeholder="Search..." aria-label="Search..." />
                            </div> --}}
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            @if (Auth::check())
                                <!-- User -->
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                        data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online">
                                            @if (Auth::user()->avt == null)
                                                <img src="{{ asset('assets/img/avatars/user.jpg') }}" alt
                                                    class="w-px-40 h-auto rounded-circle" />
                                            @else
                                                <img src="{{ asset('assets/img/avatars/' . Auth::user()->avt) }}" alt
                                                    class="w-px-40 h-40 rounded-circle" />
                                            @endif

                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-online">
                                                            @if (Auth::user()->avt == null)
                                                                <img src="{{ asset('assets/img/avatars/user.jpg') }}"
                                                                    alt class="w-px-40 h-auto rounded-circle" />
                                                            @else
                                                                <img src="{{ asset('assets/img/avatars/' . Auth::user()->avt) }}"
                                                                    alt class="w-px-40 h-40 rounded-circle" />
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span class="fw-semibold d-block">

                                                            {{ Auth::user()->name }}

                                                        </span>
                                                        <small class="text-muted">
                                                            @if (Auth::user()->role == 1)
                                                                Admin
                                                            @else
                                                                User
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bx bx-user me-2"></i>
                                                <span class="align-middle">Trang cá nhân</span>
                                            </a>
                                        </li>                                    
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <span class="d-flex align-items-center align-middle">
                                                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                    <span class="flex-grow-1 align-middle">Billing</span>
                                                    <span
                                                        class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        <li>
                                            <form action="/logout" method="post" id="form_logout">@csrf</form>
                                            <a class="dropdown-item" onclick="Logout()" href="javascript:void(0);">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Đăng xuất</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!--/ User -->
                            @else
                                <li class="nav-item lh-1 me-3">
                                    <a href="/login">Đăng nhập</a>
                                </li>
                            @endif


                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <script>
        function Logout() {
            var submitform = document.getElementById('form_logout');
            submitform.submit();
        }
    </script>


    <script>
        $(document).ready(function() {

            var congviecs =[];

            @if (isset($congviecs) && !empty($congviecs))
                var congviecs = {!! json_encode($congviecs) !!};
            @endif


            $('.tags').select2();
            $("#tags").select2({
                ajax: {
                    url: "{{ route('getcv') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.ma_cong_viec,
                                    text: item.ten_cong_viec,
                                };
                            })
                        };

                    },
                },
                data: $.map(congviecs, function(option) {
                    return {
                        id: option.ma_cong_viec,
                        text: option.ten_cong_viec,
                        selected: true
                    };
                })

            });
        });
    </script>





    {{-- <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script> --}}
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    {{-- <script src="{{ asset('assets/js/buttons.js') }}"></script> --}}
   
    <script src="{{ asset('assets/nhanvien.js') }}"></script>

    
</body>

</html>
