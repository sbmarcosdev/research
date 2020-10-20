@extends('template.resp_template')
@section('content')
<div class="container">
    <div class="container espacamento">

        {!! $msg->texto_mensagem ?? '' !!}

        <hr>
        @if (isset($msg))
        @if ($msg->primeiro_acesso == true)
        <button type="button" class="btn btn-success" onclick="window.location='{{ url('/resposta') }}'">
            <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom">
            {{$msg->titulo_opcao_sim ?? 'Iniciar' }}
        </button>

        @endif
        <button type="button" class="btn btn-warning" onclick="window.history.back()">
            <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom">
            {{$msg->titulo_opcao_nao ?? 'Encerrar' }}
        </button>
        @endif
    </div>
</div>
@endsection