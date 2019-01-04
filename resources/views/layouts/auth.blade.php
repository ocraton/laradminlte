<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'UpsManager') }}</title>

    <link rel="stylesheet" href="css/app.css">
    
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>{{ config('app.name', 'UpsManager') }}</b></a>
  </div>
  @yield('content')
  
<script src="js/app.js"></script>

</body>
</html>
