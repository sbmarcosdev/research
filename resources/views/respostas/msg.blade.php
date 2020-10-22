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

            @if ($msg->opcao_nao)
            <button type="button" class="btn btn-danger" onclick="window.history.back()">
                <img src="{{ asset('img/008-cancelar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom">
                {{$msg->titulo_opcao_nao ?? 'Encerrar' }}
            </button>
            @endif
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
            $('.rodape').css({
                "visibility": "hidden"
            });
    });
  
</script>
@endsection