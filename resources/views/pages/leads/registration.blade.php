<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <script src="{{ asset('js/laravel.app.js') }}"></script> -->
    <!-- <script src="main.js"></script> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin-ext" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('form/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('form/css/jquery.bxslider.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('form/css/font.css') }}"/>
    <link rel="stylesheet" href="{{ asset('form/css/uniform-default.css') }}"/>
    <link rel="stylesheet" href="{{ asset('form/css/bootstrap-select.css') }}"/>
    <link rel="stylesheet" href="{{ asset('form/css/sweetalert.css') }}"/>
    <link rel="stylesheet" href="{{ asset('form/css/default.css') }}"/>
    <link rel="stylesheet" href="{{ asset('form/css/default.date.css') }}"/>
    <link rel="stylesheet" href="{{ asset('form/css/style.css') }}"/>
</head>
<body>
    <div id="appVue">
        <router-view></router-view>
    </div>
    
    <script type="text/javascript" src="{{ asset('form/js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/jquery.bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/jquery.uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/legacy.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/picker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('form/js/picker.date.js') }}"></script>
    <script src="{{ asset('js/laravel.app.js') }}"></script>
</body>
</html>