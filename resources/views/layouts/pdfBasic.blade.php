<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

{{--    Ikonok--}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('material/img/favicon.png') }}">
    <link rel="apple-touch-icon" type="image/png" sizes="57x57" href="{{ asset('material/img/apple-icon-57.png') }}"><!-- iPhone -->
    <link rel="apple-touch-icon" type="image/png" sizes="72x72" href="{{ asset('material/img/apple-icon-72.png') }}"><!-- iPad -->
    <link rel="apple-touch-icon" type="image/png" sizes="114x114" href="{{ asset('material/img/apple-icon-114.png') }}"><!-- iPhone4 -->
    <link rel="icon" type="image/png" href="{{ asset('material/img/favicon-144.png') }}"><!-- Opera Speed Dial, at least 144×114 px -->

    <title>@yield('title')</title>
</head>
<body>
    @yield('content')
</body>
</html>
