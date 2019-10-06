<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="md-scrollbar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?php $email = isset(session()->all()['email']) ? session()->all()['email']:'Anonymous'; ?>
    <title>{{ config('app.name', 'Laravel') }} - <?=$email?></title>
    <!-- Scripts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/vue-material.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/theme/default.css">
    <link href="{{ asset('css/page_css/main_style.css') }}" rel="stylesheet">
</head>
<body>
<?php
$appColor = isset(session()->all()['theme']) ? session()->all()['theme']['mainBG']['color']:'';

?>

    <div id="app" class="grey-lightest" style="<?=($appColor!=''?("background-color:".$appColor." !important"):'')?>">
        <div class="container-fluid p-0">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('/js/page_scripts/main_script.js') }}"></script>
</body>
</html>
