<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IoT Panel - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('template') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template') }}/css/sb-admin-2.min.css" rel="stylesheet">

    {{-- Custom Switchery --}}
    <link href="{{ asset('template') }}/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template') }}/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template') }}/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template') }}/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template') }}/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet"
        type="text/css" />

    @yield('style')

    <!-- ION Slider -->
    <link href="{{ asset('template') }}/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" type="text/css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Spectrum CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
    {{-- 
    <style>
        .navbar-nav{
            position: relative;
        }
    </style> --}}

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.menu')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div class="col-xl-10 m-0 p-0 col-md-9 col-sm-10">
            <div id="content-wrapper" class="d-flex flex-column w-100 ml-0">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    @include('layouts.navbar')
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">@yield('title_menu')</h1>
                            @yield('button')
                        </div>

                        <!-- Content Row -->
                        @yield('content')

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                @include('layouts.footer')
                <!-- End of Footer -->

            </div>
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
                    <a class="btn btn-primary" id="logout-link" href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('template') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ asset('template') }}/js/sb-admin-2.min.js"></script>
    <script src="{{ asset('template') }}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{ asset('template') }}/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('template') }}/js/demo/chart-pie-demo.js"></script>
    <script src="{{ asset('template') }}/mohithg-switchery/switchery.min.js"></script>
    <script src="{{ asset('template') }}/selectize/js/standalone/selectize.min.js"></script>
    <script src="{{ asset('template') }}/multiselect/js/jquery.multi-select.js"></script>
    <script src="{{ asset('template') }}/select2/js/select2.min.js"></script>
    <script src="{{ asset('template') }}/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="{{ asset('template') }}/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
    <script src="{{ asset('template') }}/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    {{-- <script src="{{ asset('template') }}/jquery-mockjax/jquery.mockjax.min.js"></script> --}}
    <script src="{{ asset('template') }}/js/form-advanced.init.js"></script>
    <script src="{{ asset('template') }}/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="{{ asset('template') }}/js/range-sliders.init.js"></script>
    <script src="{{ asset('template') }}/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>



    <script type="text/javascript">
        if (!localStorage.getItem("token")) {
            window.location = "/";
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#logout-link").click(function(event) {
                event.preventDefault();
                var token = localStorage.getItem("token");
                $.ajax({
                    type: "POST",
                    url: "{{ route('auth.logout') }}",
                    headers: {
                        "Authorization": "Bearer " + token
                    },
                    success: function(data) {
                        console.log("Logout successful!");
                        localStorage.removeItem("token");
                        window.location.href = "/";
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error("Logout error: " + xhr.responseText);
                    }
                });
            });
        });
    </script>

    @stack('scripts')

</body>

</html>
