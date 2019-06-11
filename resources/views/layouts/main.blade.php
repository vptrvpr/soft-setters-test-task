<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="{{env('APP_URL')}}/css/sb-admin-2.css" rel="stylesheet">
    <link href="{{env('APP_URL')}}/css/style.css?12" rel="stylesheet">

    <!-- Styles -->

</head>
<body>
<div id="app">
    @yield('content')
</div>
</body>

<script src="{{env('APP_URL')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{env('APP_URL')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{env('APP_URL')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="{{env('APP_URL')}}/js/app.js"></script>
<script src="{{env('APP_URL')}}/js/sb-admin-2.min.js"></script>
</html>
