@extends('template.resp_template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <a class="mb-4">Campanha {{ $resp->campanha->descricao }}</a> |
        <a class="mb-4"> {{ $resp->respondente->nome }}</a>
        <hr>
        <form action="{{url('/resposta')}}" method="POST" autocomplete="off">
            @csrf
            @method('patch')

            <input type="hidden" name="sim_nao">
            <input type="hidden" name="tipo_id" value="2">
            <input type="hidden" name="pergunta_id" value="{{$pergunta->id}}">

            <table id="rtable" name="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Perguntas</th>
                        @forelse($opcoesNum as $opcao)
                        <th>{!! $opcao->titulo !!} </th>
                        @empty
                        @endforelse
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{!! $pergunta->texto !!}</td>
                        <td>
                            <div class="radio"><input type="radio" name="peso_resposta" value="1" required></div>
                        </td>
                        <td>
                            <div class="radio"><input type="radio" name="peso_resposta" value="2" required></div>
                        </td>
                        <td>
                            <div class="radio"><input type="radio" name="peso_resposta" value="3" required></div>
                        </td>
                        <td>
                            <div class="radio"><input type="radio" name="peso_resposta" value="4" required></div>
                        </td>
                        <td>
                            <div class="radio"><input type="radio" name="peso_resposta" value="5" required></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <label for="descricao">Comentários</label>
                <input type="text" name="texto_resposta" class="form-control" id="texto_resposta">
            </div>
            <button type="submit" class="btn btn-outline-success mb-4">Enviar Respostas</button>
            <hr>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{$progresso}}%;" aria-valuenow="{{$progresso}}" aria-valuemin="0" aria-valuemax="100">{{$qtd}}</div>
            </div>
    </div>


    <hr>
</div>

@endsection