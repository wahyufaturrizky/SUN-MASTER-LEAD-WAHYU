<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Event Registration</title>

        <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Fonts and Styles -->
        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/jquery-auto-complete/jquery.auto-complete.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/ion-rangeslider/css/ion.rangeSlider.skinHTML5.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/dropzonejs/dist/dropzone.css') }}">

        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/corporate.css') }}"> -->
        {{--
        <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/pulse.css') }}"> --}}
        <style>
            #MyForm {
                display: none;
                width: 300px;
                border: 1px solid #ccc;
                padding: 14px;
                background: #ececec;
            }

            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=date]::-webkit-inner-spin-button,
            input[type=date]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
        @yield('css_after')
    </head>
    <body>

        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

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
        {{-- <img class="mx-auto d-block" src="{{ asset('media/logoSun/logo-sun.png') }}" style="position: relative; top: 10px; margin-top:20px; margin-bottom:30px; "> --}}
        <div id="page-container" class="main-content-boxed">
            <!-- Main Container -->
            <main id="main-container">
                <div class="bg-body-light hero-bubbles">
                    <span class="hero-bubble wh-40 pos-t-20 pos-l-10 bg-primary"></span>
                    <span class="hero-bubble wh-30 pos-t-20 pos-l-80 bg-success"></span>
                    <span class="hero-bubble wh-20 pos-t-40 pos-l-25 bg-corporate"></span>
                    <span class="hero-bubble wh-40 pos-t-30 pos-l-90 bg-pulse"></span>
                    <span class="hero-bubble wh-30 pos-t-40 pos-l-20 bg-danger"></span>
                    <span class="hero-bubble wh-30 pos-t-60 pos-l-25 bg-warning"></span>
                    <span class="hero-bubble wh-30 pos-t-60 pos-l-80 bg-info"></span>
                    <span class="hero-bubble wh-40 pos-t-75 pos-l-70 bg-flat"></span>
                    <span class="hero-bubble wh-40 pos-t-75 pos-l-10 bg-earth"></span>
                    <span class="hero-bubble wh-30 pos-t-90 pos-l-90 bg-elegance"></span>
                    <div class="row no-gutters justify-content-center">
                        <div class="hero-static col-lg-9">
                            <div class="content content-full overflow-hidden">
                                <!-- Header -->
                                <!-- <div class="py-30 text-center row"> -->
                                    <!-- <a class="link-effect font-w700" href="index.html">
                                        <i class="si si-fire"></i>
                                        <span class="font-size-xl text-primary-dark">code</span><span class="font-size-xl">base</span>
                                    </a> -->

                                    <!-- <div class="col-lg-3">
                                        <img class="img img-responsive" src="{{ asset('/img/logo-dark.png') }}">
                                    </div>
                                    <div class="col-lg-9">
                                        <h1 class="h4 font-w700 mt-30 mb-10">Welcome to your new web app installation</h1>
                                        <h2 class="h5 font-w400 text-muted mb-0">Let's get started, it will only take a few seconds!</h2>
                                    </div> -->
                                <!-- </div> -->
                                <!-- END Header -->

                                <!-- Installation form -->
                                <!-- jQuery Validation functionality is initialized with .js-validation-installation class in js/pages/op_installation.min.js') }} which was auto compiled from _es6/pages/op_installation.js -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                @isset($eventGroup)
                                    <form class="js-validation-installation" action="{{ route('applyEventGroup',['event_group_id' => $eventGroup->event_group_id]) }}" method="POST" autocomplete="off">
                                @else
                                    <form class="js-validation-installation" action="{{ route('applyEvent',['event_id' => $event->event_id]) }}" method="post" autocomplete="off">
                                @endif
                                    @csrf
                                    <div class="block block-rounded block-shadow">
                                        <div class="block-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @isset($eventGroup)
                                                    <h3 class="text-center mb-1">{{ $eventGroup->event_group_name }}</h3>
                                                    @else
                                                        <h3 class="text-center mb-1">{{ $event->event_name }}</h3>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if(!isset($eventGroup))
                                        <hr>
                                        <div class="block-header">
                                            {{-- <h3 class="block-title"><strong><h4 class="block-title">Location: {{ $event->location }}</h4></strong></h3> --}}
                                            <span class="col-6">
                                                <h3 class="block-title pull-left">
                                                    <strong>Location: {{ $event->location }}</strong>
                                                </h3>
                                            </span>
                                            <span class="col-6">
                                                <h3 class="block-title pull-right">
                                                    <strong>{{ $event->startTime() }} - {{ $event->endTime() }}, {{ date_format(date_create($event->start_date),"d F Y") }}</strong>
                                                </h3>
                                            </span>
                                        </div>
                                        @endif
                                        <hr>
                                        <div class="block-content">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    {{-- Left Side --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <input type="text" value="{{ old('full_name') }}" class="form-control" id="full_name" name="full_name" placeholder="Please enter your full name" autocomplete="off" required autocomplete="off">
                                                                <label for="full_name">Student Name</label>
                                                                @if ($errors->has('full_name'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('full_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <input type="text" value="{{ old('mobile') }}" class="form-control noscroll" name="mobile" id="mobile" placeholder="Please enter your mobile phone" autocomplete="off" required autocomplete="off">
                                                                <label for="mobile">Mobile Phone</label>
                                                                @if ($errors->has('mobile'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('mobile') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <input type="email" class="form-control" id="email" name="email" placeholder="Please enter your active email" autocomplete="off" required autocomplete="off">
                                                                <label for="email">Email</label>
                                                                @if ($errors->has('email'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('email') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <input type="text" value="{{ old('birth') }}" class="js-datepicker form-control" id="birth" name="birth" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required autocomplete="off">
                                                                <label for="birth">Date of Birth</label>
                                                                @if ($errors->has('birth'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('birth') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <select class="js-select2 form-control" id="gender" name="gender" style="width: 100%;" data-placeholder="Select gender" required autocomplete="off">
                                                                    <option value="">Select one</option>
                                                                    <option value="m">Male</option>
                                                                    <option value="f">Female</option>
                                                                </select>
                                                                <label for="gender">Gender</label>
                                                                @if ($errors->has('gender'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('gender') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <input type="text" value="{{ old('parents_name') }}" class="form-control" id="parents_name" name="parents_name" placeholder="Please enter your parents name" autocomplete="off" required autocomplete="off">
                                                                <label for="parents_name">Parents name</label>
                                                                @if ($errors->has('parents_name'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('parents_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <input type="text" value="{{ old('parents_mobile') }}" class="form-control" name="parents_mobile" id="parents_mobile" placeholder="Please enter your parents mobile phone" autocomplete="off" required autocomplete="off">
                                                                <label for="parents_mobile">Parents Mobile Phone</label>
                                                                @if ($errors->has('parents_mobile'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('parents_mobile') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <input class="form-control" id="address" name="address" rows="4" placeholder="Please enter your full address" style="resize:none;" autocomplete="off" required autocomplete="off">
                                                                <label for="address">Full Address</label>
                                                                @if ($errors->has('address'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('address') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <select class="js-select2 ajaxPostalCode form-control" id="postal_code_id" name="postal_code_id" data-placeholder="Select one" required></select>
                                                                <label for="postal_code_id">Post Code/City Area</label>
                                                                @if ($errors->has('postal_code_id'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('postal_code_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <input type="text" value="{{ old('phone') }}" class="form-control" name="phone" id="phone" placeholder="Please enter your home address phone" autocomplete="off">
                                                                <label for="phone">Home Address Phone</label>
                                                                @if ($errors->has('phone'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Right Side --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <select class="js-select2 form-control" id="highest_edu_id" name="highest_edu_id" style="width: 100%;" data-placeholder="Select student grade" required autocomplete="off">
                                                                    <option value="">Select one</option>
                                                                    @foreach($highestEdus as $highestEdu)
                                                                        <option value="{{ $highestEdu->highest_edu_id }}">{{ $highestEdu->highest_edu }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="highest_edu_id">Current Education Grade</label>
                                                                @if ($errors->has('highest_edu_id'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('highest_edu_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <select class="ajaxSchool form-control" name="school_id" required></select>
                                                                <label for="school_id">Name of Previous / Current School</label>
                                                                @if ($errors->has('school_id'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('school_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <select class="js-select2 form-control" id="major_interested" name="major_interested" style="width: 100%;" data-placeholder="Select one" required>
                                                                    <option value="">Select one</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                    @foreach($majors as $major)
                                                                        <option value="{{ $major->major_name }}">{{ $major->major_name }} - {{ $major->fieldOfStudy->field_of_study_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="major_interested">Major Interested</label>
                                                                @if ($errors->has('major_interested'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('major_interested') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <select class="js-select2 form-control" id="destination_of_study_id" name="destination_of_study_id" style="width: 100%;" data-placeholder="Select one" required>
                                                                    <option value="">Select one</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                    @foreach($countries as $country)
                                                                        <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="destination_of_study_id">Destination of Study</label>
                                                                @if ($errors->has('destination_of_study_id'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('destination_of_study_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <select class="js-select2 form-control" id="program_interested_id" name="program_interested_id" style="width: 100%;" data-placeholder="Select one" required>
                                                                    <option value="">Select one</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                    @foreach($programInterested as $prog)
                                                                        <option value="{{ $prog->program_interested_id }}">{{ $prog->program_interested }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="program_interested_id">Program Interested</label>
                                                                @if ($errors->has('program_interested_id'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('program_interested_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                <select class="js-select2 form-control" id="planning_year" name="planning_year" style="width: 100%;" data-placeholder="Select one.." required autocomplete="off">
                                                                    <option value="">Select one</option>
                                                                    <option value="2019" selected>2019</option>
                                                                    <option value="2020">2020</option>
                                                                    <option value="2021">2021</option>
                                                                    <option value="2022">2022</option>
                                                                    <option value="2023">2023</option>
                                                                    <option value="2024">2024</option>
                                                                    <option value="2025">2025</option>
                                                                </select>
                                                                <label for="planning_year">Planning Year</label>
                                                                @if ($errors->has('planning_year'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('planning_year') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="form-material">
                                                                @isset($eventGroup)
                                                                    <select class="js-select2 form-control" id="marketing_source_id" name="marketing_source_id" style="width: 100%;" data-placeholder="Select one" required>
                                                                        <option value="">Select one</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                        @foreach($marketingSources as $marketingSource)
                                                                            <option value="{{ $marketingSource->marketing_source_id }}">{{ $marketingSource->marketing_source_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <select class="js-select2 form-control" id="marketing_source_id" name="marketing_source_id" style="width: 100%;" data-placeholder="Select one" required>
                                                                        <option value="">Select one</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                        @foreach($event->marketingSources() as $marketingSource)
                                                                            <option value="{{ $marketingSource->marketing_source_id }}">{{ $marketingSource->marketing_source_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                                <label for="marketing_source">Know this event from?</label>
                                                                @if ($errors->has('marketing_source'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('marketing_source') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            {{-- <div class="form-material"> --}}
                                                                <label for="has_contact_sun">Ever Contact SUN Office?</label>
                                                                @if ($errors->has('has_contact_sun'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('has_contact_sun') }}</strong>
                                                                    </span>
                                                                @endif
                                                                <br>
                                                                <label class="css-control css-control-primary css-radio">
                                                                    @if ($errors->has('has_contact_sun'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('has_contact_sun') }}</strong>
                                                                    </span>
                                                                @endif
                                                                    <input type="radio" class="css-control-input" value="Yes" id="has_contact_sun" name="has_contact_sun" required autocomplete="off">
                                                                    <span class="css-control-indicator"></span> Yes
                                                                </label>
                                                                <label class="css-control css-control-primary css-radio">
                                                                    @if ($errors->has('has_contact_sun'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('has_contact_sun') }}</strong>
                                                                    </span>
                                                                @endif
                                                                    <input type="radio" class="css-control-input" value="No" id="has_contact_sun" name="has_contact_sun" required autocomplete="off">
                                                                    <span class="css-control-indicator"></span> No
                                                                </label>
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div id="selectOfficeOrBranch" class="form-group d-none">
                                                            <div class="form-material" id="try">
                                                                <select class="js-select2 form-control" id="knowThisEvent" name="branch_id" style="width: 100%;" data-placeholder="Select one..">
                                                                    <option value="">Select one</option>
                                                                    @foreach($branches as $branch)
                                                                        <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="office">Select Office / Branch</label>
                                                                @if ($errors->has('branch_id'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('branch_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        @isset($eventGroup)
                                                        <div class="form-group">
                                                            <div class="form-material" id="try">
                                                                <select class="js-select2 form-control" id="event_ids" name="event_ids" data-placeholder="Select one" multiple required>
                                                                    <option value="">Select one</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                    @foreach($eventGroup->events as $event)
                                                                        {{-- <option value="{{ $event->event_id }}">{{ $event->event_name }}</option> --}}
                                                                        <option value="{{ $event->event_id }}">{{ $event->event_name }}, {{ $event->location }}, {{ date_format(date_create($event->start_date), 'd F Y') }}, {{ date_format(date_create($event->start_time), 'H:i') }}-{{ date_format(date_create($event->end_time), 'H:i') }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="event_ids">Select Event</label>
                                                                @if ($errors->has('event_ids'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('event_ids') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endisset

                                                        {{-- <div class="col-md-6">
                                                            <p>Ever Contact SUN Office? &nbsp
                                                                <button type="button" id="hide" class="btn">No</button>&nbsp
                                                                <button type="button" id="show" class="btn">Yes</button>
                                                            </p>

                                                            <br>

                                                            <button type="submit" class="btn btn-danger">Sign Up</button>
                                                            <br>
                                                            <br>
                                                            <br>
                                                        </div>     --}}

                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row justify-content-end">
                                                    {{-- <div class="col-lg-6"> --}}
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-alt-info mr-3 mt-3" data-wizard="finish">
                                                                <i class="si si-check mr-5"></i> Apply
                                                            </button>
                                                        </div>
                                                    {{-- </div> --}}
                                                </div>
                                            </div>
                                            <!-- End Form -->
                                        </div>
                                    </div>
                                </form>
                                <!-- END Installation Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!--
            Codebase JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out _es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            {{ asset('js/core/jquery.min.js') }}
            {{ asset('js/core/bootstrap.bundle.min.js') }}
            {{ asset('js/core/simplebar.min.js') }}
            {{ asset('js/core/jquery-scrollLock.min.js') }}
            {{ asset('js/core/jquery.appear.min.js') }}
            {{ asset('js/core/jquery.countTo.min.js') }}
            {{ asset('js/core/js.cookie.min.js') }}
        -->


        <!--
            Codebase JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at asset('_es6/main/app.js
        -->
        <script src="{{ mix('js/codebase.app.js') }}"></script>
        <script src="{{ mix('js/laravel.app.js') }}"></script>
        <script src="{{ asset('js/plugins/offline/offline.js') }}"></script>

        <!-- Page JS Plugins -->
        <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ asset('js/pages/op_installation.min.js') }}"></script>


        <!-- Page JS Plugins -->
        <script src="{{ asset('js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('js/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
        <script src="{{ asset('js/plugins/jquery-auto-complete/jquery.auto-complete.min.js') }}"></script>
        <script src="{{ asset('js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ asset('js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
        <script src="{{ asset('js/plugins/dropzonejs/dropzone.min.js') }}"></script>

        <!-- Page JS Helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins) -->
        <script>jQuery(function(){ Codebase.helpers(['datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'tags-inputs']); });</script>


        <!-- Page JS Plugins -->
        <script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('/js/plugins/jquery-validation/additional-methods.js') }}"></script>

        <!-- Page JS Helpers (Select2 plugin) -->
        <script>jQuery(function(){ Codebase.helpers('select2'); });</script>

        <!-- Page JS Code -->
        {{-- <script src="{{ asset('/js/pages/be_forms_validation.min.js') }}"></script> --}}

        @yield('js_after')

        <script type="text/javascript">
            jQuery(document).ready(function(){
                // VALIDATION
                jQuery('.js-validation-material').validate({
                    ignore: [],
                    errorClass: 'invalid-feedback animated fadeInDown',
                    errorElement: 'div',
                    errorPlacement: (error, e) => {
                        jQuery(e).parents('.form-group').append(error);
                    },
                    highlight: e => {
                        jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
                    },
                    success: e => {
                        jQuery(e).closest('.form-group').removeClass('is-invalid');
                        jQuery(e).remove();
                    },
                    rules: {
                        'val-username2': {
                            required: true,
                            minlength: 3
                        },
                        'val-email2': {
                            required: true,
                            email: true
                        },
                        'val-password2': {
                            required: true,
                            minlength: 5
                        },
                        'val-confirm-password2': {
                            required: true,
                            equalTo: '#val-password2'
                        },
                        'val-select22': {
                            required: true
                        },
                        'val-select2-multiple2': {
                            required: true,
                            minlength: 2
                        },
                        'val-suggestions2': {
                            required: true,
                            minlength: 5
                        },
                        'val-skill2': {
                            required: true
                        },
                        'val-currency2': {
                            required: true,
                            currency: ['$', true]
                        },
                        'val-website2': {
                            required: true,
                            url: true
                        },
                        'val-phoneus2': {
                            required: true,
                            phoneUS: true
                        },
                        'val-digits2': {
                            required: true,
                            digits: true
                        },
                        'val-number2': {
                            required: true,
                            number: true
                        },
                        'val-range2': {
                            required: true,
                            range: [1, 5]
                        },
                        'val-terms2': {
                            required: true
                        }
                    },
                    messages: {
                        'val-username2': {
                            required: 'Please enter your a username',
                            minlength: 'Your username must consist of at least 3 characters'
                        },
                        'val-email2': 'Please enter your a valid email address',
                        'val-password2': {
                            required: 'Please provide a password',
                            minlength: 'Your password must be at least 5 characters long'
                        },
                        'val-confirm-password2': {
                            required: 'Please provide a password',
                            minlength: 'Your password must be at least 5 characters long',
                            equalTo: 'Please enter your the same password as above'
                        },
                        'val-select22': 'Please select a value!',
                        'val-select2-multiple2': 'Please select at least 2 values!',
                        'val-suggestions2': 'What can we do to become better?',
                        'val-skill2': 'Please select a skill!',
                        'val-currency2': 'Please enter your a price!',
                        'val-website2': 'Please Please enter your website!',
                        'val-phoneus2': 'Please enter your a US phone!',
                        'val-digits2': 'Please enter your only digits!',
                        'val-number2': 'Please enter your a number!',
                        'val-range2': 'Please enter your a number between 1 and 5!',
                        'val-terms2': 'You must agree to the service terms!'
                    }
                });

                // AUTOCOMPLETE - POSTAL CODE
                jQuery('.js-autocomplete-postal-code').autoComplete({
                    minChars: 1,
                    source: function( request, response ) {
                        $.ajax({
                            url: "/api/masterdata/postalCode",
                            dataType: "json",
                            type: 'POST',
                            data: {
                                q: request
                            },
                            success: function( data ) {
                                console.log('data')
                                console.log(data)
                                response( data );
                            }
                        });
                    },
                    renderItem: function (item, search){
                        return '<div class="autocomplete-suggestion" data-val="'+item.postal_code_number+'">'+item.postal_code_number+ ' ('+item.kelurahan+', '+item.kabupaten+', '+item.propinsi+', '+item.kabupaten+'</div>';
                    },
                });

                // AUTOCOMPLETE - PRECUR SCHOOL
                jQuery('.js-autocomplete-school').autoComplete({
                    minChars: 1,
                    source: function( request, response ) {
                        $.ajax({
                            url: "/api/masterdata/precurSchool",
                            dataType: "json",
                            type: 'POST',
                            data: {
                                q: request
                            },
                            success: function( data ) {
                                response( data );
                            }
                        });
                    },
                    renderItem: function (item, search){
                        return '<div class="autocomplete-suggestion" data-val="'+item.name+'">'+item.name+ ' ('+item.kabupaten+')</div>';
                    },
                });

                // AUTOCOMPLETE - MAJOR INTERESTED
                jQuery('.js-autocomplete-major-interested').autoComplete({
                    minChars: 1,
                    source: function( request, response ) {
                        $.ajax({
                            url: "/api/masterdata/majorInterested",
                            dataType: "json",
                            type: 'POST',
                            data: {
                                q: request
                            },
                            success: function( data ) {
                                response( data );
                            }
                        });
                    },
                    renderItem: function (item, search){
                        return '<div class="autocomplete-suggestion" data-val="'+item.major_name+' - '+item.field_of_study.fos_name+'">'+item.major_name+' - '+item.field_of_study.fos_name+'</div>';
                    },
                });

                $('#zip_code').select2({
                    placeholder: "Search...",
                    allowClear: true,
                    ajax: {
                        url: '/api/masterdata/postalCode',
                        type: 'post',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                q: params.term,
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function (data) {
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: data
                            };
                        }
                    }
                });
                $('#zip_code').on('select2:select', function (e) {
                    $( "#zip_code" ).valid()
                });

                $('#highest_edu_id').on('select2:select', function (e) {
                    $( "#highest_edu_id" ).valid()
                });

                $('#precur_school_id').select2({
                    placeholder: "Please enter your school or university",
                    allowClear: true,
                    ajax: {
                        url: '/api/masterdata/precurSchool',
                        type: 'post',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                q: params.term,
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function (data) {
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: data
                            };
                        }
                    }
                });
                $('#precur_school_id').on('select2:select', function (e) {
                    $( "#precur_school_id" ).valid()
                });

                $('#major_interested_id').select2({
                    placeholder: "Please enter your program interested",
                    allowClear: true,
                    ajax: {
                        placeholder: 'Search...',
                        url: '/api/masterdata/majorInterested',
                        type: 'post',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                q: params.term,
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function (data) {
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: data
                            };
                        }
                    }
                });
                $('#major_interested').on('select2:select', function (e) {
                    $( "#major_interested" ).valid()
                });

                $('#gender').on('select2:select', function (e) {
                    $( "#gender" ).valid()
                });

                $('#birth').on('change keyup blur', function (e) {
                    $( "#birth" ).valid()
                });

                $('#destination_of_study_id').on('change keyup blur', function (e) {
                    $( "#destination_of_study_id" ).valid()
                });

                $('#program_interested_id').on('change keyup blur', function (e) {
                    $( "#program_interested_id" ).valid()
                });

                $('#event_ids').on('change keyup blur', function (e) {
                    $( "#event_ids" ).valid()
                });

                jQuery("body").on('change',"input[name='has_contact_sun']", function(){
                    if(this.value == 'Yes'){
                        $('#selectOfficeOrBranch').removeClass('d-none');
                        $('#knowThisEvent').val(null).trigger('change');

                        // $('#knowThisEvent').select2('destroy');
                        // $('#knowThisEvent').select2({
                        //     placeholder: "Select office",
                        //     allowClear: true,
                        // });


                        $("#knowThisEvent").rules("add",{
                            required: true
                        });
                        // $( "#knowThisEvent" ).valid();

                    } else if(this.value == 'No'){
                        $('#selectOfficeOrBranch').addClass('d-none');
                        $('#knowThisEvent').val(null).trigger('change');


                        // $('#knowThisEvent').select2('destroy');
                        // $('#knowThisEvent').select2({
                        //     placeholder: "Select office",
                        //     allowClear: true,
                        // });

                        $("#knowThisEvent").rules("remove");
                        $("#knowThisEvent").valid();
                    }
                });

                $('#marketing_source_id').on('change keyup blur', function (e) {
                    $( "#marketing_source_id" ).valid()
                });

                $('#knowThisEvent').on('change keyup blur', function (e) {
                    $( "#knowThisEvent" ).valid();
                });

                $('.ajaxPostalCode').on('select2:select', function (e) {
                    $( ".ajaxPostalCode" ).valid()
                });

                $('.ajaxSchool').on('select2:select', function (e) {
                    $( ".ajaxSchool" ).valid()
                });

            });
        </script>
        <script>

            jQuery(document).ready(function(){
                jQuery('.js-datepicker:not(.js-datepicker-enabled)').add('.input-daterange:not(.js-datepicker-enabled)').each((index, element) => {
                    let el = jQuery(element);

                    // Add .js-datepicker-enabled class to tag it as activated and init it
                    el.addClass('js-datepicker-enabled').datepicker({
                        weekStart: el.data('week-start') || 0,
                        autoclose: el.data('autoclose') || false,
                        todayHighlight: el.data('today-highlight') || false,
                        orientation: 'bottom' // Position issue when using BS4, set it to bottom until officially supported
                    });
                });

                jQuery('.js-autocomplete').autoComplete({
                    minChars: 1,
                    source: function(term, suggest){
                        term = term.toLowerCase();

                        let countriesList  = ['Afghanistan','Albania','Algeria','Andorra','Angola','Anguilla','Antigua &amp; Barbuda','Argentina','Armenia','Aruba','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bermuda','Bhutan','Bolivia','Bosnia &amp; Herzegovina','Botswana','Brazil','British Virgin Islands','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Cape Verde','Cayman Islands','Chad','Chile','China','Colombia','Congo','Cook Islands','Costa Rica','Cote D Ivoire','Croatia','Cruise Ship','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Estonia','Ethiopia','Falkland Islands','Faroe Islands','Fiji','Finland','France','French Polynesia','French West Indies','Gabon','Gambia','Georgia','Germany','Ghana','Gibraltar','Greece','Greenland','Grenada','Guam','Guatemala','Guernsey','Guinea','Guinea Bissau','Guyana','Haiti','Honduras','Hong Kong','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Isle of Man','Israel','Italy','Jamaica','Japan','Jersey','Jordan','Kazakhstan','Kenya','Kuwait','Kyrgyz Republic','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Macau','Macedonia','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Mauritania','Mauritius','Mexico','Moldova','Monaco','Mongolia','Montenegro','Montserrat','Morocco','Mozambique','Namibia','Nepal','Netherlands','Netherlands Antilles','New Caledonia','New Zealand','Nicaragua','Niger','Nigeria','Norway','Oman','Pakistan','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal','Puerto Rico','Qatar','Reunion','Romania','Russia','Rwanda','Saint Pierre &amp; Miquelon','Samoa','San Marino','Satellite','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','South Africa','South Korea','Spain','Sri Lanka','St Kitts &amp; Nevis','St Lucia','St Vincent','St. Lucia','Sudan','Suriname','Swaziland','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Timor L\'Este','Togo','Tonga','Trinidad &amp; Tobago','Tunisia','Turkey','Turkmenistan','Turks &amp; Caicos','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Venezuela','Vietnam','Virgin Islands (US)','Yemen','Zambia','Zimbabwe'];
                        let suggestions    = [];

                        for (i = 0; i < countriesList.length; i++) {
                            if (~ countriesList[i].toLowerCase().indexOf(term)) suggestions.push(countriesList[i]);
                        }

                        suggest(suggestions);
                    }
                });

                // Init Select2 (with .js-select2 class)
                jQuery('.js-select2:not(.js-select2-enabled)').each((index, element) => {
                    let el = jQuery(element);

                    // Add .js-select2-enabled class to tag it as activated and init it
                    el.addClass('js-select2-enabled').select2({
                        placeholder: el.data('placeholder') || false
                    });
                });

                $('.ajaxSchool').select2({
                    ajax: {
                        url: '/api/data/ajaxSchool',
                        method: 'POST',
                        dataType: 'json',
                        processResults: function(data){
                            return {
                                results: data
                            };
                        }
                        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                    },
                    placeholder: 'Please type your school'
                });

                $('.ajaxPostalCode').select2({
                    ajax: {
                        url: '/api/data/ajaxPostalCode',
                        method: 'POST',
                        dataType: 'json',
                        processResults: function(data){
                            return {
                                results: data
                            };
                        }
                        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                    },
                    placeholder: 'Please type your post code/city Area'
                });

                // Init Masked Inputs
                // a - Represents an alpha character (A-Z,a-z)
                // 9 - Represents a numeric character (0-9)
                // * - Represents an alphanumeric character (A-Z,a-z,0-9)
                jQuery('.js-masked-date:not(.js-masked-enabled)').mask('99/99/9999');
                jQuery('.js-masked-date-dash:not(.js-masked-enabled)').mask('99-99-9999');
                jQuery('.js-masked-phone:not(.js-masked-enabled)').mask('(999) 999-9999');
                jQuery('.js-masked-phone-number:not(.js-masked-enabled)').mask('+(99) 9999-9999-9?99');
                jQuery('.js-masked-phone-ext:not(.js-masked-enabled)').mask('(999) 999-9999? x99999');
                jQuery('.js-masked-taxid:not(.js-masked-enabled)').mask('99-9999999');
                jQuery('.js-masked-ssn:not(.js-masked-enabled)').mask('999-99-9999');
                jQuery('.js-masked-pkey:not(.js-masked-enabled)').mask('a*-999-a999');
                jQuery('.js-masked-time:not(.js-masked-enabled)').mask('99:99');

                jQuery('.js-masked-date')
                    .add('.js-masked-date-dash')
                    .add('.js-masked-phone')
                    .add('.js-masked-phone-number')
                    .add('.js-masked-phone-ext')
                    .add('.js-masked-taxid')
                    .add('.js-masked-ssn')
                    .add('.js-masked-pkey')
                    .add('.js-masked-time')
                    .addClass('js-masked-enabled');
            });
        </script>
    </body>
</html>
