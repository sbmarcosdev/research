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
    --vCss: {{ Session::get('cor_primaria')}};
        text-align: center;
        text-color: var(--vCss) !important;
        padding: 10px;
        font-weight: bold;
    }

    .titulosub {
        --vCss2: {{Session::get('cor_secundaria')}};
        text-align: left;
        text-color: var(--vCss2)!important;
        margin-bottom: 20px;
        font-weight: bold;
    }

@media all and (max-width: 800px) and (orientation:landscape) {
   .rodape {
       visibility: hidden;
   }
}

@media all and (max-width: 800px) and  (orientation:portrait) {
   .rodape {
       visibility: visible;
   }
}
    
</style>

<header>
    <div style="position:absolute; top:0; left:0; right:0;">
        @if(Session::get('banner_empresa'))
        <img src="{{asset(Session::get('banner_empresa'))}}" width="100%" height="100px">
        
        <div style="position:absolute; top:0px; left:0px;">
            <img src="{{asset(Session::get('logo_empresa'))}}" width="70%" class="ml-5 mt-2">
        </div>
        @endif
    </div>
</header>
