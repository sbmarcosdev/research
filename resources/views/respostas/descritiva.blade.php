@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <a class="mb-4">Campanha {{ $resp->campanha->descricao }}</a> |
        <a class="mb-4"> {{ $resp->respondente->nome }}</a>
        <hr>
        <form action="{{('/resposta')}}" method="POST">
            @csrf
            @method('patch')

            <input type="hidden" name="pergunta_id" value="{{$pergunta->id}}">
            <input type="hidden" name="tipo_id" value="{{$pergunta->tipo_id}}">

            <p> {{ $pergunta->texto }} </p>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="texto_resposta"></textarea>

            <hr>

            <button type="submit" class="btn btn-outline-success mb-4">Enviar Respostas</button>
            <hr>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{$resp->progresso}}%;" aria-valuenow="{{$resp->progresso}}" aria-valuemin="0" aria-valuemax="100">{{$resp->qtd}}</div>
            </div>
    </div>


</div>

@endsection