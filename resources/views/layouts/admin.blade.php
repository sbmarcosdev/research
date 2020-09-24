<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Pesquisa de Satisfação</title>
  <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />

  <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
  @yield('styles')
</head>
@yield('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')

</html>

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
      padding: 10px;
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