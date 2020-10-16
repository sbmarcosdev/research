@extends('template.resp_template')
@section('content')
<div class="container">
    <div class="container espacamento">

        {!! $msg->texto_mensagem ?? '' !!}

        <hr>
        @if (isset($msg))
            @if ($msg->primeiro_acesso == true)
                <input type="button" value="{{$msg->titulo_opcao_sim ?? 'Iniciar' }}" onclick="window.location='{{ url('/resposta') }}'">
            @endif
        
            <input type="button" value="{{$msg->titulo_opcao_nao ?? 'Encerrar' }}" id="fechar" onclick="window.history.back()">

        @endif
    </div>
</div>
@endsection