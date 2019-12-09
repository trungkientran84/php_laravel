<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to share square</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@yield('css')
    <!-- Styles -->
    <style>

    </style>
</head>
<body>
@include('layouts/header');
<section>
    @yield('body')
</section>
@include('layouts/footer');
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>
