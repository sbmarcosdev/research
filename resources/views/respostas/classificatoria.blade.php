@extends('template.resp_template')
@section('content')


<style>
    .classifica {
        padding: 0.5rem !important;
    }
</style>


<div class="container">
    <div class="espacamento">

        <h4 class="tituloPrincipal">{{ $resp->campanha->descricao }}</h4>

        <h5 class="titulosub"> {{ $resp->respondente->nome }}</h5>

        <h5>{!! $pergunta->texto !!}</h5>


        <a class="mt-2">{{ $pergunta->texto_ajuda }}</a>

        <form action="{{url('/resposta')}}" method="POST" autocomplete="off">
            @csrf
            @method('patch')

            <input type="hidden" name="sim_nao">
            <input type="hidden" name="tipo_id" value="1">
            <input type="hidden" name="pergunta_id" value="{{$pergunta->id}}">

            <table id="rtable" name="table" class="table table-striped table-bordered mt-2 text-center">
                <thead>
                    <tr>
                        @forelse($opcoes as $opcao)
                        <th class="classifica">{!! $opcao->titulo !!} </th>
                        @empty
                        @endforelse
                    </tr>
                </thead>
                <tbody>
                    <div class="radio">
                        <tr>
                            @forelse($opcoes as $opcao)
                            <th style="width: 3px;">
                                <input type="radio" name="peso_resposta" value="{{$opcao->peso}}" required>
                            </th>
                            @empty
                            @endforelse

                        </tr>
                    </div>
                </tbody>
            </table>
            @if($pergunta->opcao_justificativa)
            <div class="form-group">
                <label for="descricao">{{ $pergunta->titulo_justificativa ?? 'Comentários' }}</label>
                <input type="text" name="texto_resposta" class="form-control" id="texto_resposta" required>
            </div>
            @endif
            <div class="tituloPrincipal mt-3">
                <button type="submit" class="btn btn-outline-info mb-4">Enviar Respostas</button>
            </div>
            <div class="progress mt-3">
                <div class="progress-bar" role="progressbar" style="width: {{$progresso}}%;" aria-valuenow="{{$progresso}}" aria-valuemin="0" aria-valuemax="100">{{$qtd}}</div>
            </div>
    </div>
</div>
</div>
@endsection