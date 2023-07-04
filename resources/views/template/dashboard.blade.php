<!DOCTYPE html>

<html lang="es"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../../../../assets/"
    data-template="vertical-menu-template"><!--layout-navbar-fixed-->
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

        <title>@yield('title')</title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="../../../assets/img/favicon/favicon.ico" />

        <link rel="apple-touch-icon" sizes="57x57" href="../../../assets/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../../../assets/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../../../assets/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../../../assets/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../../../assets/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../../../assets/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../../../assets/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../../../assets/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="../../../assets/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../../../assets/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/img/favicon/favicon-16x16.png">
        <!-- <link rel="manifest" href="../../../assets/img/favicon/manifest.json"> -->
        <meta name="msapplication-TileColor" content="#171D49">
        <meta name="msapplication-TileImage" content="../../../assets/img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#171D49">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
        />

        <!-- Icons -->
        <link rel="stylesheet" href="../../../assets/vendor/fonts/fontawesome.css" />
        <link rel="stylesheet" href="../../../assets/vendor/fonts/tabler-icons.css" />
        <link rel="stylesheet" href="../../../assets/vendor/fonts/flag-icons.css" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="../../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="../../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="../../../assets/css/demo.css" />
        <link rel="stylesheet" href="../../../assets/css/style.css" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <link rel="stylesheet" href="../../../assets/vendor/libs/node-waves/node-waves.css" />
        <link rel="stylesheet" href="../../../assets/vendor/libs/typeahead-js/typeahead.css" />
        <link rel="stylesheet" href="../../../assets/vendor/libs/apex-charts/apex-charts.css" />
        <link rel="stylesheet" href="../../../assets/vendor/libs/swiper/swiper.css" />
        <link rel="stylesheet" href="../../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
        <link rel="stylesheet" href="../../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
        <link rel="stylesheet" href="../../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
        <link rel="stylesheet" href="../../../assets/vendor/libs/select2/select2.css" />
        <link rel="stylesheet" href="../../../assets/vendor/libs/toastr/toastr.css" />
        <link rel="stylesheet" href="../../../assets/vendor/libs/animate-css/animate.css" />
        <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

        <!-- Page CSS -->
        <link rel="stylesheet" href="../../../assets/vendor/css/pages/cards-advance.css" />
        
        <!-- Helpers -->
        <script src="../../../assets/vendor/js/helpers.js"></script>
        <script src="../../../assets/js/config.js"></script>
        <script>
            let _token = "{{ session('accessToken') }}";
            const _application = "{{ \App\Models\Ism::APPLICATION }}";
            const _idOrganizacion = "{{ \App\Models\Ism::IDORGANIZACION }}";
            const api_url = "{{ \App\Models\Ism::BASE_URL }}";
            const url_site = "{{ url('/') }}";
        </script>
    </head>

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                @include('template.sidebar')
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">

                    <!-- Navbar -->
                    @include('template.navbar')
                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            @yield('content')
                        </div>
                        <!-- / Content -->

                        <!-- Footer -->
                        @include('template.footer')
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->

                </div>
                <!-- / Layout page -->
            </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../../assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="../../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../../assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="../../assets/vendor/libs/block-ui/block-ui.js"></script>

    <script src="../../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="../../../assets/vendor/libs/swiper/swiper.js"></script>
    <script src="../../../assets/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="../../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../../../assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="../../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="../../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js"></script>
    <script src="../../../assets/vendor/libs/select2/select2.js"></script>
    <script src="../../../assets/js/forms-selects.js"></script>
    <script src="../../../assets/vendor/libs/toastr/toastr.js"></script>
    <link rel="stylesheet" href="../../assets/vendor/libs/spinkit/spinkit.css" />
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <!-- Main JS -->
    <script src="../../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../../assets/js/dashboards-analytics.js"></script>
    <script src="../../assets/js/extended-ui-perfect-scrollbar.js"></script>
    <script src="../../assets/js/typeahead.bundle.js"></script>

    <!-- ISM -->
    <script src="../../../assets/js/ism-helper.js"></script>
    </body>
</html>