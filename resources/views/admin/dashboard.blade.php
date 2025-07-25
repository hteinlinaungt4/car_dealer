<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('admin/css/sb-admin-2.min.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.min.css">
    <style>
        .color {
            /* The dark background from the theme */
            /* background-color: #212529; */
            background-color: #203354;
            /* Off-white text for good readability */
            color: #F8F9FA;

            /* The red accent used for a strong border */
            /* border: 3px solid #E63946; */

            /* Some extra styling to make it look nice */
            padding: 25px;
            /* border-radius: 8px; */
            font-size: 1.2em;
            font-weight: bold;
        }
        .hello a{
            color: #858796!important;
        }

    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav color sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a href="{{ route('overallcount') }}"
                class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-text mx-3">{{ __('messages.admin_title')}}</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            {{-- <li class="nav-item">
                <a class="nav-link" href="" >
                    <i class="fa-solid fa-gauge"></i>
                    <span>Dashboard</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link" href="{{ route('overallcount') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ __('messages.admin_dashboard')}}</span>
                </a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('company.index') }}">
                    <i class="fa fa-university"></i>
                    <span>{{ __('messages.admin_company')}}</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('car.index') }}">
                    <i class="fas fa-car"></i>
                    <span>{{ __('messages.admin_car')}}</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('userlist') }}">
                    <i class="fas fa-users"></i>
                    <span>{{ __('messages.admin_user_lists')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.inquiries.index') }}">
                    <i class="fa-solid fa-book"></i>
                    <span>{{ __('messages.admin_inquery_lists')}}</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.book') }}">
                    <i class="fa-solid fa-book"></i>
                    <span>{{ __('messages.admin_booking_lists')}}</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.process.index') }}">
                    <i class="fa-solid fa-book"></i>
                    <span>{{ __('messages.admin_confrim_process')}}</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.invoices.index') }}">
                    <i class="fa-solid fa-book"></i>
                    <span>{{ __('messages.admin_invoice_lists')}}</span></a>
            </li>



            <li class="nav-item">
                <a class="nav-link" href="{{ route('most') }}">
                    <i class="fa fa-car"></i>
                    <span>{{ __('messages.admin_most_interest')}}</span></a>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('best') }}">
                    <i class="fa fa-car"></i>
                    <span>{{ __('messages.admin_best_sell_cars')}}</span></a>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.about') }}">
                    <i class="fa fa-bookmark"></i>
                    <span>{{ __('messages.admin_about_us')}}</span></a>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.contact') }}">
                    <i class="fa fa-bookmark"></i>
                    <span>{{ __('messages.admin_contact_us')}}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-white color topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <li class="dropdown nav-item hello">
                            <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-globe mr-2"></i>
                                {{ app()->getLocale() == 'en' ? 'English' : 'Myanmar' }}
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                        href="{{ route('locale.switch', ['locale' => 'en']) }}">
                                        English
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ app()->getLocale() == 'my' ? 'active' : '' }}"
                                        href="{{ route('locale.switch', ['locale' => 'my']) }}">
                                        Myanmar
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 large ">{{ Auth::user()->name }}
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                </span>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('adminpassword#changepage') }}">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                   {{__('messages.admin_change_password')}}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('messages.admin_logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->



                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- End of Main Content -->



        </div>

        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    @yield('script')


    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js),datatables.mark.js"></script>
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
