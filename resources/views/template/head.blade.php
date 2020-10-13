<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <title>Pesquisa</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi+2&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-html5-1.6.5/datatables.min.css" />

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-html5-1.6.5/datatables.min.js"></script>



    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{asset('assets/popper.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/script.js')}}"></script>
    <script src="{{asset('assets/sbmscript.js')}}"></script>
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

    @yield('styles')

    @yield('scripts')
</head>

<style>
    .corEbracon {
        background: #ac2228 !important;
    }

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

    .card-body {
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        box-shadow: 2px 2px 1px #DCDCDC;
        -webkit-box-shadow: 2px 2px 1px #DCDCDC;
        -moz-box-shadow: 2px 2px 1px #DCDCDC;
    }

    body {
        font-family: 'Baloo Thambi 2', cursive !important;
        background-color: white;
    }

    .tituloPrincipal {
        text-align: center;
        /* color: #ac2228; */
        color: #735294 !important;
        padding: 0px;
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .titulosub {
        text-align: center;
        color: #735294 !important;
        padding: 20px;
        font-weight: bold;
    }
</style>