<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pesquisa</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi+2&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    @yield('styles')
    @yield('scripts')
</head>

<style>

    .espacamento {
        margin-top: 100px;
    }

    .tituloPrincipal {
        text-align: center;
        color: {{ Session::get('cor_primaria')}} !important;
        padding: 5px;
        font-weight: bold;
    }

    .titulosub {
        text-align: right;
        color: {{ Session::get('cor_secundaria') }}!important;
        padding: 5px;
        font-weight: bold;
    }
</style>