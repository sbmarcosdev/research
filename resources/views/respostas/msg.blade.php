@extends('template.resp_template')
@section('content')
<div class="container">
    <div class="container espacamento">

        {!! $msg->texto_mensagem ?? '' !!}

        <hr>
        @if (isset($msg))
        @if ($msg->primeiro_acesso == true)
        
        <input type="button" value="{{$msg->titulo_opcao_sim ?? 'Iniciar' }}" onclick="window.location='{{ url('/resposta') }}'">
        
        @if ($msg->opcao_nao)
        <input type="button" value="{{$msg->titulo_opcao_nao ?? 'Não' }}" id="fechar" onclick="window.history.back()">
        @endif
        @endif
        @endif
    </div>
</div>
@endsection