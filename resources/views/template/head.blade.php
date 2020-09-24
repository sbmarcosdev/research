<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <title>Pesquisa de Satisfação</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi+2&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    
    <script src="{{ asset('js/main.js') }}"></script>

    <script src="{{url("assets/popper.min.js")}}"></script>
    <script src="{{url("assets/bootstrap.min.js")}}"></script>
    <script src="{{url("assets/script.js")}}"></script>
    <script src="{{url("assets/sbmscript.js")}}"></script>

@yield('styles')

@yield('scripts')

</head>

<body>

    <style>
        .corEbracon {
            background: #ac2228 !important;
        }

        .li_menu_topo {
            font-weight: bold;
            color: #fff !important;
            font-size: 16px !important;
        }

        .espacamento {
            padding: 100px;
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
            padding: 20px;
            font-weight: bold;
        }

        .titulosub {
            text-align: center;
            color: #735294 !important;
            padding: 20px;
            font-weight: bold;
        }
    </style>