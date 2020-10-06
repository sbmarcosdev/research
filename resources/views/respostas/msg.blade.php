@extends('template.template')
@section('content')
<div class="container">
    <div class="container espacamento">


        {!! $msg->texto_mensagem ?? '' !!}

        <hr>
        @if (isset($msg))
        @if ($msg->primeiro_acesso == true)
        <input type="button" value="Responder" onclick="window.location='{{ url('/resposta') }}'">
        @endif
        @endif
    </div>

</div>
@endsection