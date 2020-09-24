@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <a class="mb-4">Campanha {{ $resp->campanha->descricao }}</a> |
        <a class="mb-4"> {{ $resp->respondente->nome }}</a>
        <hr>
        <form action="/resposta" method="POST">
            <input type="hidden" name="tipo_id" value="3">
            @csrf
            @method('patch')

            <table id="rtable" name="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Perguntas</th>
                        @forelse($afirmativa as $opcao)
                        <th>{{ $opcao->titulo }} </th>
                        @empty
                        @endforelse
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $pergunta->texto }}</td>
                        <td>
                            <div class="radio"><input type="radio" name="pergunta_id[{{$pergunta->id}}]" value="5" onclick="jsSimNao('S')" required></div>
                        </td>
                        <input type="hidden" name="sim_nao" id="sim_nao">
                        <td>
                            <div class="radio"><input type="radio" name="pergunta_id[{{$pergunta->id}}]" value="1" onclick="jsSimNao('N')" required></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <label for="descricao">Comentários</label>
                <input type="text" name="texto_resposta" class="form-control" id="texto_resposta">
            </div>
            <button type="submit" class="btn btn-outline-success mb-4">Enviar Respostas</button>
    </div>
    <hr>
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{$resp->progresso}}%;" aria-valuenow="{{$resp->progresso}}" aria-valuemin="0" aria-valuemax="100">{{$resp->qtd}}</div>
    </div>
    <hr>
</div>

@endsection