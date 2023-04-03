<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin_assets/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/summernote/summernote-bs4.min.css')}}'">

    @section('links')
    @show
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->

            <!-- Messages Dropdown Menu -->

            <!-- Notifications Dropdown Menu -->

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                   role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            {{--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">--}}
            <span class="brand-text">Alpha Ecommerce</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->

            <!-- SidebarSearch Form -->


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="{{url('admin/dashboard')}}" class="nav-link @yield('dashboard_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="{{url('admin/users')}}" class="nav-link @yield('user_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="{{url('admin/business_details')}}" class="nav-link @yield('business_detail_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Business DetailsN
                            </p>
                        </a>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="{{url('admin/wishlist')}}" class="nav-link @yield('wishlist_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Wish Lists
                            </p>
                        </a>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="{{url('admin/cart')}}" class="nav-link @yield('cart_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Cart
                            </p>
                        </a>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="{{url('admin/orders')}}" class="nav-link @yield('order_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Orders
                            </p>
                        </a>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="{{url('admin/offers')}}" class="nav-link @yield('discount_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Discounts
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">CATEGORY</li>
                    <li class="nav-item {{'active' ? 'menu-is-opening menu-open' :'' }}">
                        <a href="#" class="nav-link {{'active' ? 'menu-is-opening menu-open' :'' }} @yield('product_category_select') @yield('offer_category_select')  @yield('user_category_select')">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>
                                Categories
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="{{'active' ? 'display:block' :'' }}">
                            <li class="nav-item">
                                <a href="{{url('admin/categories')}}" class="nav-link @yield('product_category_select')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Product Categories
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('admin/user-categories')}}" class="nav-link @yield('user_category_select')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        User Categories
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('admin/offer-categories')}}" class="nav-link @yield('offer_category_select')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Offer Categories
                                    </p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item menu-open">
                        <a href="{{url('admin/brands')}}" class="nav-link @yield('brand_select')">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Brands
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="{{url('admin/products')}}" class="nav-link @yield('product_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="{{url('admin/privacy-policy')}}" class="nav-link @yield('privacy_policy_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Privacy policy
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="{{url('admin/faqs')}}" class="nav-link @yield('faq_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                FAQ
                            </p>
                        </a>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="{{url('admin/admin-list')}}" class="nav-link @yield('admin_list_select')">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Admins
                            </p>
                        </a>
                    </li>



                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    @section('container')
    @show
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin_assets/plugins/jquery-ui/jquery-ui.min.js')}}'"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- ChartJS -->
<script src="{{asset('admin_assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin_assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('admin_assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin_assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin_assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('admin_assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_assets/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_assets/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin_assets/dist/js/pages/dashboard3.js')}}"></script>

@section('scripts')
@show
</body>
</html>
