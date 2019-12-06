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
                    <div class="block">
                        <div class="block-header block-header-default" style="background-color:#cccccc">
                            <h3 class="block-title text-center"><strong>Registration - {{ $event->eventType->event_type_name }}</strong></h3>
                        </div>
                        <div class="block-content">
                            <h3 class="text-center">Success</h3>
                            <h4 class="text-center">Registration ID: {{ $eventRegistration->register_id }}</h4>
                        </div>
                        <hr class="hr-sm my-1">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('linkRegistrationEvent', ['event_id' => $event->event_id, 'slug' => $event->slug, 'lang_id' => 'en']) }}" target="_blank" class="btn btn-alt-secondary mx-1 text-center mb-4" data-toggle="tooltip" title="Back to Registration Page">Back to Registration Page</a>
                                </div>
                            </div>
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
