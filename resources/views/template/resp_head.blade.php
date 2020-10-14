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
    .li_menu_topo {
        font-weight: bold;
        color: #fff !important;
        font-size: 14px !important;
    }

    .espacamento {
        margin-top: 150px;
        position: absolute;
        padding: 0px;
    }

    .fases {
        position: absolute;
        margin-top: 90px;
        margin-left: 160px;
        width: 25%;

    }

    .fasesTitulo {
        margin-top: 105px;
        position: absolute;
        margin-left: 520px;
        color: #735294 !important;
        font-weight: bold;
    }

    .quebraLinha {
        margin-top: 7px;
        margin-bottom: 7px;
    }

    body {
        font-family: 'Baloo Thambi 2', cursive !important;
        background-color: white;
    }

    .tituloPrincipal {
        text-align: center;
        color: {{ Session::get('cor_primaria')}} !important;
        padding: 5px;
        font-weight: bold;
    }

    .titulosub {
        text-align: left;
        color: {{ Session::get('cor_secundaria')}} !important;
        padding: 5px;
        font-weight: bold;
    }
</style>