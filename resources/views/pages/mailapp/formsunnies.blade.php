<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Master Leads</title>

        <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon-sun.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/corporate.css') }}"> -->
        {{-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/pulse.css') }}"> --}}
        @yield('css_after')
        <style>
            body {
                margin: 0;
                padding 0;
            }
        </style>
        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body>
        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Codebase() -> uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-inverse'                           Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Classic Header style if no class is added
            'page-header-modern'                        Modern Header style
            'page-header-inverse'                       Dark themed Header (works only with classic Header style)
            'page-header-glass'                         Light themed Header with transparency by default
                                                        (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
            'page-header-glass page-header-inverse'     Dark themed Header with transparency by default
                                                        (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        <div id="page-container" class="sidebar-inverse side-scroll page-header-inverse page-header-fixed main-content-boxed enable-page-overlay">
            <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow bg-black-op-10">
                        <div class="content-header-section text-center align-parent">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="">
                                    <i class="si si-fire text-primary"></i>
                                    <span class="font-size-xl text-dual-primary-dark">code</span><span class="font-size-xl text-primary">base</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                    </div>
                    <!-- END Side Header -->

                    <!-- Side Main Navigation -->
                    <div class="content-side content-side-full">
                        <!--
                        Mobile navigation, desktop navigation can be found in #page-header

                        If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
                        -->
                        <ul class="nav-main">
                            <li>
                                <a class="active" href="">
                                    <i class="si si-cup"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-main-heading">
                                Heading
                            </li>
                            <li>
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                    <i class="si si-puzzle"></i> Dropdown
                                </a>
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)">Link #1</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Link #2</a>
                                    </li>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">Dropdown</a>
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Link #1</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Link #2</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="si si-rocket"></i> More
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Side Main Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content content-full">
                    <!-- Hero -->
                    <div class="block block-rounded">
                        <div class="block-content">
                            <div class="py-20">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-12" for="example-select">Select</label>
                                        <div class="col-md-12">
                                            <select id="1st" class="form-control">
                                                <option value="Branch">Branch</option>
                                                <option value="Country">Country</option>
                                                <option value="School of Origin">School of Origin</option>
                                                <option value="Program Study (Major & Degree)">Program Study (Major & Degree)</option>
                                                <option value="Leads Type">Leads Type</option>
                                                <option value="Scholarship Seeker">Scholarship Seeker</option>
                                            </select>
                                            <select id="branch" class="form-control hide">
                                                <option value="Counselor">Counselor</option>
                                                <option value="Status">Status</option>
                                            </select>
                                            <select id="country" class="form-control hide">
                                                <option value="Counselor">Counselor</option>
                                                <option value="Status">Status</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12" for="example-select">Select</label>
                                        <div class="col-md-12">

                                        </div>
                                    </div>
                                </form>

                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        var html = '';

                                        $('#1st').change(function(){
                                            if (this.value == 'Branch'){
                                                // html +=
                                                $('#1st').html(html);
                                            } else if (this.value == 'Country'){

                                            } else if (this.value == 'School of Origin'){

                                            } else if (this.value == 'Program Study (Major & Degree)'){

                                            } else if (this.value == 'Leads Type'){

                                            } else if (this.value == 'Scholarship Seeker'){

                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- END Hero -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right">
                        Crafted with <i class="fa fa-heart text-pulse"></i> by <a class="font-w600" href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="https://1.envato.market/95j" target="_blank">Codebase</a> &copy; <span class="js-year-copy"></span>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase JS -->
        <script src="assets/js/codebase.core.min.js"></script>
        <script src="assets/js/codebase.app.min.js"></script>
    </body>
</html>
