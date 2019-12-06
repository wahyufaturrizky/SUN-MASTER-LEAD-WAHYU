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
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/jquery-auto-complete/jquery.auto-complete.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/ion-rangeslider/css/ion.rangeSlider.skinHTML5.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/dropzonejs/dist/dropzone.css') }}">

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
        <img class="mx-auto d-block" src="{{ asset('media/logoSun/logo-sun.png') }}" style="position: relative; top: 10px; margin-top:20px; margin-bottom:30px; "></<img>
        <div id="page-container" class="main-content-boxed">
            <main id="main-container">
                <div class="content">
                    <div class="block" style="min-height:900px;">
                        <div class="block-header block-header-default" style="background-color:#cccccc">
                            <h3 class="block-title text-center"><strong>Registration - {{ $event->eventType->event_type_name }}</strong></h3>
                        </div>

                        <div class="block-header block-header-default" style="background-color:#ece5dd">
                            <h3 class="block-title"><strong>{{ $event->event_name }}<br><h4 class="block-title">Location: {{ $event->location }}</h4></strong></h3>
                            <span class="pull-left">
                                <h3 class="block-title">
                                    <strong>{{ $event->startTime() }} - {{ $event->endTime() }}, {{ date_format(date_create($event->start_date),"d F Y") }}</strong>
                                </h3>
                            </span>
                        </div>
                        <div class="block-content">
                            <!-- Main Form -->
                            <form action="{{ route('applyEvent',['event_id' => $event->event_id]) }}" method="POST" autocomplete="off">
                                <div class="col-md-12">
                                    <div class="row">
                                        @csrf

                                        <div class="form-group col-md-6" {{ $errors->has('full_name') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <input type="text" value="{{ old('full_name') }}" class="form-control" id="full_name" name="full_name" placeholder="Please enter your full name" autocomplete="off" required>
                                                <label for="full_name">Student Name</label>
                                                @if ($errors->has('full_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('full_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('highest_edu_id') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <select class="js-select2 form-control" id="highest_edu_id" name="highest_edu_id" style="width: 100%;" data-placeholder="Select one">
                                                    <option value="">Select one</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                    @foreach($highestEdus as $highestEdus)
                                                        <option value="{{ $highestEdus->highest_edu_id }}">{{ $highestEdus->highest_edu }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="educationGrade">Current Education Grade</label>
                                                @if ($errors->has('highest_edu_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('highest_edu_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('mobile') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <input type="text" class="js-masked-phone-number form-control" id="mobile" name="mobile" placeholder="+(00) 0000-0000-000">
                                                <label for="mobile">Mobile Phone</label>
                                                @if ($errors->has('mobile'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('mobile') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('school_id') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                {{-- <input type="text" class="form-control" id="previousCurrentSchool" name="previousCurrentSchool" placeholder="Enter your school / University" autocomplete="off" required> --}}
                                                <select class="ajaxSchool form-control" name="school_id" required></select>
                                                <label for="school_id">Name of Previous / Current School</label>
                                                @if ($errors->has('school_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('school_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('email') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Please enter a valid email address" autocomplete="off" required>
                                                <label for="email">Email</label>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('major_interested') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                {{-- <input type="text" class="form-control" id="major_interested" name="major_interested" placeholder="Enter your program interested" autocomplete="off" required> --}}
                                                <select class="js-select2 form-control" name="major_interested" style="width: 100%;" data-placeholder="Select one">
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

                                        <div class="form-group col-md-6" {{ $errors->has('birth') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <input type="text" class="js-datepicker form-control" id="birth" name="birth" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                                <label for="birth">Date of Birth</label>
                                                @if ($errors->has('birth'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('birth') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('destination_of_study_id') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <select class="js-select2 form-control" name="destination_of_study_id" style="width: 100%;" data-placeholder="Select one">
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

                                        <div class="form-group col-md-6" {{ $errors->has('gender') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <select class="form-control" id="gender" name="gender" required>
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

                                        <div class="form-group col-md-6" {{ $errors->has('program_interested_id') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <select class="js-select2 form-control" name="program_interested_id" style="width: 100%;" data-placeholder="Select one">
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

                                        <div class="form-group col-md-6" {{ $errors->has('parents_name') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <input type="text" class="form-control" id="parents_name" name="parents_name" placeholder="Enter your parents name" autocomplete="off" required>
                                                <label for="parents_name">Parents name</label>
                                                @if ($errors->has('parents_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('parents_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('planning_year') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <select class="form-control" id="planning_year" name="planning_year" required>
                                                    <option value="">Select one</option>
                                                    <option value="2019">2019</option>
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

                                        <div class="form-group col-md-6" {{ $errors->has('parents_mobile') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <input type="text" class="js-masked-phone-number form-control" id="example-masked-phone-number" name="parents_mobile" placeholder="+(00) 0000-0000-000">
                                                <label for="parents_mobile">Parents Mobile Phone</label>
                                                @if ($errors->has('parents_mobile'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('parents_mobile') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('address') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <input class="form-control" id="address" name="address" rows="4" placeholder="Please add your address" style="resize:none;" autocomplete="off" required>
                                                <label for="address">Full Address</label>
                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('postal_code_id') ? ' is-invalid' : '' }}>
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

                                        <div class="form-group col-md-6" {{ $errors->has('phone') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <input type="text" class="js-masked-phone-number form-control" id="phone" name="phone" placeholder="+(00) 0000-0000-000">
                                                <label for="phone">Home Address Phone</label>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('marketing_source_id') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <select class="js-select2 form-control" id="marketing_source_id" name="marketing_source_id" style="width: 100%;" data-placeholder="Select one">
                                                    <option value="">Select one</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                    @foreach($event->marketingSources() as $marketingSource)
                                                        <option value="{{ $marketingSource->marketing_source_id }}">{{ $marketingSource->marketing_source_name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="knowThisEvent">Know this event from?</label>
                                                @if ($errors->has('marketing_source_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('marketing_source_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6" {{ $errors->has('has_contact_sun') ? ' is-invalid' : '' }}>
                                            <div class="form-material">
                                                <select class="form-control" id="has_contact_sun" name="has_contact_sun" required>
                                                    <option value="">Select one</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                <label for="has_contact_sun">Ever Contact SUN Office??</label>
                                                @if ($errors->has('has_contact_sun'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('has_contact_sun') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 {{ $errors->has('branch_id') ? ' is-invalid' : '' }}">
                                            <div class="form-material" id="try">
                                                <select class="js-select2 form-control" id="example2-select2" name="branch_id" style="width: 100%;" data-placeholder="Select one">
                                                    <option value="">Select one</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                    @foreach($branches as $branch)
                                                        <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="branch_id">Select Office / Branch</label>
                                                @if ($errors->has('branch_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('branch_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="col-md-12 my-5" style="margin-top: 15px; padding-top: 15px; padding-bottom: 15px; border-top: 1px solid #eee">
                                            <button type="submit" class="btn btn-alt-primary pull-right">Sign Up</button>
                                        </div>

                                    </div>
                                </div>

                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div>
            <main>

            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right hide d-none">
                        <i class="fa fa-heart text-pulse"></i> <a class="font-w600" href="">Click to view Indonesian Version</a>
                    </div>
                    <div class="float-left">
                        <span class="font-w600">Copyright © SUN Education Group 2019</span>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>

        <!-- Codebase Core JS -->
        {{-- <script src="{{ mix('js/codebase.app.js') }}"></script> --}}

        <!-- Laravel Scaffolding JS -->
        {{-- <script src="{{ mix('js/laravel.app.js') }}"></script> --}}

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('js/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
        <script src="{{ asset('js/plugins/jquery-auto-complete/jquery.auto-complete.min.js') }}"></script>
        <script src="{{ asset('js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ asset('js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
        <script src="{{ asset('js/plugins/dropzonejs/dropzone.min.js') }}"></script>
        <script src="{{ asset('js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $("#hide").click(function() {
                    $("#try").hide();
                });
                $("#show").click(function() {
                    $("#try").show();
                });
            });

            function hanyaAngka(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))

                    return false;
                return true;
            }

            $(document).on("wheel", "input[type=number]", function(e) {
                $(this).blur();
            });
        </script>
        @yield('js_after')
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
