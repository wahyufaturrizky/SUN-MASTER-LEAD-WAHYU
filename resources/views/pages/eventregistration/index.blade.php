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

        <!-- Scripts -->
        <script>
            window.Laravel = {
                !!json_encode(['csrfToken' => csrf_token(), ]) !!
            };
        </script>
    </head>
    <body>
        <img class="mx-auto d-block" src="{{ asset('media/logoSun/logo-sun.png') }}" style="position: relative; top: 10px; margin-top:20px; margin-bottom:30px; "></<img>
        <div id="page-container" class="main-content-boxed">
            <main id="main-container">
                <div class="content">
                    <div class="block" style="min-height:900px;">
                        <div class="block-header block-header-default" style="background-color:#cccccc">
                            <h3 class="block-title text-center">Event Registration</h3>
                        </div>

                        <div class="block-header block-header-default" style="background-color:#ece5dd">
                            <h3 class="block-title">{{ $event->name }}</h3>
                            <span class="pull-left">
                                <h3 class="block-title">
                                    {{ $event->start_date }} - {{ $event->start_time }}
                                </h3>
                            </span>
                        </div>
                        <div class="block-content">
                            <!-- Main Form -->
                            <form action="" method="post">
                                <div class="col-md-12">
                                    <div class="row">
                                        @csrf
                                        <input type="hidden" name="form_id" id="form_id" value="XXXX">
                                        <input type="hidden" name="slug" id="slug" value="XXX">
                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <input type="text" class="form-control" id="studentName" name="studentName" placeholder="Please enter your Fullname" autocomplete="off" required>
                                                <label for="material-text">Student Name</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <select class="form-control" id="educationGrade" name="educationGrade" required>
                                                    <option value="">...</option>
                                                    <option value="S2 / Master">S2 / Master</option>
                                                    <option value="S1 / Bachelor">S1 / Bachelor</option>
                                                    <option value="Diploma">Diploma</option>
                                                </select>
                                                <label for="educationGrade">Current Education educationGrade</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <input type="number" class="form-control noscroll" name="mobilePhone" id="mobilePhone" placeholder="Mobile phone" autocomplete="off" required>
                                                <label for="mobilePhone">Your Mobile Phone</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <input type="text" class="form-control" id="previousCurrentSchool" name="previousCurrentSchool" placeholder="Enter your school / University" autocomplete="off" required>
                                                <label for="previousCurrentSchool">Name of Previous / Current School</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Active Email" autocomplete="off" required>
                                                <label for="email">Email</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <input type="text" class="form-control" id="majorInterested" name="majorInterested" placeholder="Enter your program interested" autocomplete="off" required>
                                                <label for="majorInterested">Major Interested</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <label for="dateBirth">Date of Birth</label>
                                                <input type="date" class="form-control" name="dateBirth" id="dateBirth" placeholder="" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <select class="form-control" id="destinationStudy" name="destinationStudy" required>
                                                    <option value="">...</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="China">China</option>
                                                </select>
                                                <label for="destinationStudy">Destination of Study</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <select class="form-control" id="gender" name="gender" required>
                                                    <option value="">...</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <label for="gender">Gender</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <select class="form-control" id="programInterested" name="programInterested" required>
                                                    <option value="">...</option>
                                                    <option value="English Course">English Course</option>
                                                    <option value="High School">High School</option>
                                                    <option value="Diploma / Voactional">Diploma / Voactional</option>
                                                </select>
                                                <label for="programInterested">Program Interested</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <input type="text" class="form-control" id="parentsName" name="parentsName" placeholder="Enter your parents name" autocomplete="off" required>
                                                <label for="parentsName">Parents name</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <select class="form-control" id="planningYear" name="planningYear" required>
                                                    <option value="">...</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2019">2019</option>
                                                </select>
                                                <label for="planningYear">Planning Year</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <input type="number" class="form-control" name="parentsMobilePhone" id="parentsMobilePhone" placeholder="Mobile phone" autocomplete="off" required>
                                                <label for="parentsMobilePhone">Parents Mobile Phone</label>
                                            </div>
                                        </div>

                                        {{--
                                        <div class="col-md-6">
                                            <div class="form-material">
                                                <textarea class="form-control" id="fullAddress" name="fullAddress" rows="4" placeholder="Please add your address" style="resize:none;"></textarea>
                                                <label for="fullAddress">Full Address</label>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-6">
                                            <div class="form-material">
                                                <input class="form-control" id="fullAddress" name="fullAddress" rows="4" placeholder="Please add your address" style="resize:none;" autocomplete="off" required>
                                                <label for="fullAddress">Full Address</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <input type="number" class="form-control" id="postCode" name="postCode" placeholder="Select your location by post or city area" autocomplete="off" required>
                                                <label for="postCode">Post Code/City Area</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <input type="number" class="form-control" name="homeAddressPhone" id="homeAddressPhone" placeholder="Enter your home phone" autocomplete="off" required>
                                                <label for="homeAddressPhone">Home Address Phone</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-material">
                                                <select class="form-control" id="knowThisEvent" name="knowThisEvent" required>
                                                    <option value="">Select reference</option>
                                                    <option value="Attend School Expo">Attend School Expo</option>
                                                    <option value="Baliho">Baliho</option>
                                                    <option value="BBM Blast">BBM Blast</option>
                                                </select>
                                                <label for="knowThisEvent">Know this event from?</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <p>Ever Contact SUN Office? &nbsp
                                                <button type="button" id="hide" class="btn">No</button>&nbsp
                                                <button type="button" id="show" class="btn">Yes</button>
                                            </p>
                                            <div class="form-material" id="try">
                                                <select class="form-control" id="office" name="office">
                                                    <option value="">...</option>
                                                    <option value="Jakarta">Jakarta</option>
                                                    <option value="Surabaya">Surabaya</option>
                                                    <option value="Makassar">Makassar</option>
                                                </select>
                                                <label for="office">Select Office / Branch</label>
                                            </div>

                                            <br>

                                            <button type="submit" class="btn btn-alt-danger">Sign Up</button>
                                            <br>
                                            <br>
                                            <br>
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
                    <div class="float-right">
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
        <script src="{{ mix('js/codebase.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <script src="{{ mix('js/laravel.app.js') }}"></script>

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
    </body>
</html>
