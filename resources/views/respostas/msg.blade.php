@extends('template.resp_template')
@section('content')
<div class="container">
    <div class="container espacamento">

        {!! $msg->texto_mensagem ?? '' !!}

        <hr>
        @if (isset($msg))
        @if ($msg->primeiro_acesso == true)
        @if ($msg->opcao_sim)
        <input type="button" value="{{$msg->titulo_opcao_sim ?? 'Sim' }}" onclick="window.location='{{ url('/resposta') }}'">
        @endif

        @if ($msg->opcao_nao)
        <input type="button" value="{{$msg->titulo_opcao_nao ?? 'Não' }}" id="fechar" onclick="window.history.back()">
        @endif
        @endif
        @endif
    </div>
</div>
@endsection