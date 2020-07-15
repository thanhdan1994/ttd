<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Laravel Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap4.5.0.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
</head>

<body>
    <div id="app"></div>
    <script src="{{ asset('js/manifest.js')}}"></script>
    <script src="{{ asset('js/vendor.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
