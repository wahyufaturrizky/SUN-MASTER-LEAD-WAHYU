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
        {{-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/pulse.css') }}"> --}}
        <style>
            #MyForm{
                display: none;
                width: 300px;
                border: 1px solid #ccc;
                padding: 14px;
                background: #ececec;
            }
        </style>
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body>
            <img class="mx-auto d-block" src="{{ asset('media/logoSun/logo-sun.png') }}" style="position: relative; top: 10px; margin-top:20px; margin-bottom:30px; "></<img>

            <div id="page-container" class="main-content-boxed" >
            <main id="main-container">
            <div class="content" >
            <div class="block" style="min-height:900px;">
            <div class="block-header block-header-default" style="background-color:#cccccc">
                <h3 class="block-title text-center">Student Registration</h3>
            </div>
            @foreach($form_id as $i => $form)
            <div class="block-header block-header-default" style="background-color:#ece5dd">
            <h3 class="block-title">{{ $form->name }}</h3>
            <span class="pull-left">
                <h3 class="block-title">
                <?php
                    $tmpDate = $form['date'];
                    echo date("d F Y", strtotime($tmpDate));
                ?>
                </h3>
            </span>
            </div>

    <div class="block-content">
        <!-- Main Form -->
        <form action="{{ route('registration') }}" method="post">
                @csrf
            <div class="col-md-12">
                <div class="row">
            <input type="hidden" name="form_id" id="form_id" value="{{ $id = $form->form_id  }}">
            <input type="hidden" name="slug" id="slug" value="{{ $slug = $form->slug  }}">
            @endforeach

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <input type="text" class="form-control" id="studentName" name="studentName" placeholder="Masukkan Nama Anda">
                            <label for="material-text">Nama</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <select class="form-control" id="educationGrade" name="educationGrade">
                                <option>...</option>
                                <option value="S2 / Magister">S2 / Magister</option>
                                <option value="S1 / Sarjana">S1 / Sarjana</option>
                                <option value="Diploma">Diploma</option>
                            </select>
                            <label for="educationGrade">Pendidikan Saat Ini</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <input type="number" class="form-control" name="mobilePhone" id="mobilePhone" placeholder="Mobile phone">
                            <label for="mobilePhone">Nomor Handphone</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <input type="text" class="form-control" id="previousCurrentSchool" name="previousCurrentSchool" placeholder="Masukkan Nama Sekolah atau Universitas Anda">
                            <label for="previousCurrentSchool">Nama Sekolah / Universitas Terkahir</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Aktif Anda">
                            <label for="email">Alamat Email</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <input type="text" class="form-control" id="majorInterested" name="majorInterested" placeholder="Masukkan program Anda Minati">
                            <label for="majorInterested">Bidang Studi yang Diminati</label>
                        </div>
                    </div>

                     <div class="form-group col-md-6">
                        <div class="form-material">
                            <label for="dateBirth">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="dateBirth" id="dateBirth" placeholder="">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <select class="form-control" id="destinationStudy" name="destinationStudy">
                                <option>...</option>
                                <option value="Australia">Australia</option>
                                <option value="Canada">Canada</option>
                                <option value="China">China</option>
                            </select>
                            <label for="destinationStudy">Negara Tujuan</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <select class="form-control" id="gender" name="gender">
                                <option>...</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                            <label for="gender">Jenis Kelamin</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <select class="form-control" id="programInterested" name="programInterested">
                                <option>...</option>
                                <option value="English Course">English Course</option>
                                <option value="High School">High School</option>
                                <option value="Diploma / Voactional">Diploma / Voactional</option>
                            </select>
                            <label for="programInterested">Tingkat Studi Tujuan</label>
                        </div>
                    </div>

                     <div class="form-group col-md-6">
                        <div class="form-material">
                            <input type="text" class="form-control" id="parentsName" name="parentsName" placeholder="Masukkan Nama Orang Tua Anda">
                            <label for="parentsName">Nama Orang  Tua</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <select class="form-control" id="planningYear" name="planningYear">
                                <option>...</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                            </select>
                            <label for="planningYear">Tahun Masuk</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <input type="number" class="form-control" name="parentsMobilePhone" id="parentsMobilePhone" placeholder="Nomor Handphone">
                            <label for="parentsMobilePhone">Nomor Handphone Orang Tua</label>
                        </div>
                    </div>

                       <!-- <div class="col-md-6">
                        <div class="form-material">
                            <textarea class="form-control" id="address" name="address" rows="4" placeholder="Please add your address" style="resize:none;"></textarea>
                            <label for="address">Full Address</label>
                        </div>
                    </div>  -->

                    <div class="col-md-6">
                        <div class="form-material">
                            <input class="form-control" id="fullAddress" name="fullAddress" rows="4" placeholder="Masukkan Alamat Anda" style="resize:none;">
                            <label for="fullAddress">Alamat</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <input type="text" class="form-control" id="postCode" name="postCode" placeholder="Masukkan Kode Pos Anda">
                            <label for="postCode">Kode Pos</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <input type="number" class="form-control" name="homeAddressPhone" id="homeAddressPhone" placeholder="Masukkan Telepon Rumah Anda">
                            <label for="homeAddressPhone">Nomor Telepon Rumah</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-material">
                            <select class="form-control" id="knowThisEvent" name="knowThisEvent">
                                <option>Pilih sumber referensi</option>
                                <option value="1">Attend School Expo</option>
                                <option value="2">Baliho</option>
                                <option value="3">BBM Blast</option>
                            </select>
                            <label for="knowThisEvent">Tahu event ini dari?</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <p>Pernah menghubungi / mengunjungi kantor SUN? &nbsp <button type="button" id="hide" class="btn">No</button>&nbsp<button type="button" id="show" class="btn">Yes</button></p>

                        <div class="form-material" id="try">
                                    <select class="form-control" id="office" name="office">
                                        <option>...</option>
                                        <option value="1">Jakarta</option>
                                        <option value="2">Surabaya</option>
                                        <option value="3">Makassar</option>
                                    </select>
                                    <label for="office">Pilih kantor cabang</label>
                                </div>
                                <br>
                        <button type="submit" class="btn btn-alt-danger">Daftar</button><br><br>
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
                <i class="fa fa-book"></i> <a class="font-w600" href="{{ route('eventForm', [$slug]) }}" style="text-decoration:none, color:#000000">Klik untuk melihat versi Bahasa Inggris</a>
            </div>
            <div class="float-left">
                <span class="font-w600">Hak Cipta © SUN Education Group 2019</span>
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
            $(document).ready(function(){
            $("#hide").click(function(){
                $("#try").hide();
            });
            $("#show").click(function(){
                $("#try").show();
            });
            });

            function hanyaAngka(evt)
            {
		    var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
		    return true;
		    }

            $(document).on("wheel", "input[type=number]", function (e)
            {
                $(this).blur();
            });




        </script>
        @yield('js_after')
    </body>
</html>
