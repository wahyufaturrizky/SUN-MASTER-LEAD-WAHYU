@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content d-none hide">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Welcome to SUN Master Data System</h2>
            <h3 class="h5 text-muted mb-0">The most comprehensive SUN Education Database System</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="block">
                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            We’ve put everything together, so you can start working on your Laravel project as soon as possible! Codebase assets are integrated and work seamlessly with Laravel Mix, so you can use the npm scripts as you would in any other Laravel project.
                        </p>
                        <p class="font-size-sm text-muted">
                            Feel free to use any examples you like from the full versions to build your own pages. <strong>Wish you all the best and happy coding!</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    {{-- Page box --}}

         <!-- Main Container -->
         <main id="main-container">

                <!-- Page Content -->
                <div class="content content-full">
                    <div class="row invisible" data-toggle="appear">
                        <!-- Row #1 -->
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-chart fa-3x text-primary"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $count['sunnies'] }}">0</div>
                                        <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Sunnies</div>
                                    </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-chart fa-3x"></i>
                                    </div>
                                <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $count['suntrack'] }}">0</span></div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Sun Track</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-chart fa-3x text-primary"></i>
                                    </div>
                                <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $count['mobileapp'] }}">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Mobile App</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-chart fa-3x"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $count['sun-edu-web'] }}">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Sun Edu Web</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-chart fa-3x"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $count['sun-eng-web'] }}">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Sun Eng Web</div>
                                </div>
                            </a>
                        </div>
                        {{--
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-chart fa-3x text-primary"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $count['workshop'] }}">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Workshop</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-chart fa-3x"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $count['seminar'] }}">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Seminar</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-chart fa-3x text-primary"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="{{ $count['info-session'] }}">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Info Session</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-users fa-3x text-primary"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="4252">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Online</div>
                                </div>
                            </a>
                        </div> --}}
                        <!-- END Row #1 -->
                    </div>
                    </div>
                </main>

    {{-- End Page Box --}}

    <!-- Page Content -->
    <div class="content">
        <!-- Lines Chart -->
        {{-- <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Overview</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content block-content-full text-center">
                <!-- Lines Chart Container -->
                <canvas class="js-chartjs-lines"></canvas>
            </div>
        </div> --}}
        <!-- END Lines Chart -->
    </div>
@endsection

@section('js_after')
    {{-- <script src="{{ asset('js/pages/dashboard_charts.js') }}"></script> --}}
@endsection
