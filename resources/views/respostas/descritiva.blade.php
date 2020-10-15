@extends('template.resp_template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <h4 class="tituloPrincipal"> {{ $resp->campanha->descricao }} </h4>

        <h5 class="titulosub"> {{ $resp->respondente->nome }} </h5>

        <form action="{{url('/resposta')}}" method="POST">
            @csrf
            @method('patch')

            <input type="hidden" name="pergunta_id" value="{{$pergunta->id}}">
            <input type="hidden" name="tipo_id" value="{{$pergunta->tipo_id}}">
            <input type="hidden" name="peso_resposta" value="1">

            <td>{!! $pergunta->texto !!}</td>
            <td>{{ $pergunta->texto_ajuda }}</td>
            <textarea class="form-control mt-3" id="exampleFormControlTextarea1" rows="2" name="texto_resposta"></textarea>


            <button type="submit" class="btn btn-outline-success mt-3 mb-4">Enviar Respostas</button>

            <div class="progress mt-4">
                <div class="progress-bar" role="progressbar" style="width: {{$progresso}}%;" aria-valuenow="{{$progresso}}" aria-valuemin="0" aria-valuemax="100">{{$qtd}}</div>
            </div>
    </div>
</div>

@endsection