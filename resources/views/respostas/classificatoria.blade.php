@extends('template.resp_template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <h4 class="tituloPrincipal">{{ $resp->campanha->descricao }}</h4>

        <h5 class="mb-4"> {{ $resp->respondente->nome }}</h5>
        <form action="{{url('/resposta')}}" method="POST">
            @csrf
            @method('patch')

            <input type="hidden" name="sim_nao">
            <input type="hidden" name="tipo_id" value="1">
            <input type="hidden" name="pergunta_id" value="{{$pergunta->id}}">

            <table id=" rtable" name="table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Perguntas</th>
                    @forelse($opcoes as $opcao)
                    <th>{!! $opcao->titulo !!} </th>
                    @empty
                    @endforelse
                </tr>
            </thead>
            <tbody>
                <div class="radio">
                    <tr>
                        <td>{!! $pergunta->texto !!}</td>
                        @forelse($opcoes as $opcao)
                        <th>
                            <input type="radio" name="peso_resposta" value="{{$opcao->peso}}" required>
                        </th>
                        @empty
                        @endforelse
                        <!-- <td>
                            <div class="radio"><input type="radio" name="pergunta_id[{{$pergunta->id}}]" value="1" required></div>
                        </td> -->
                    </tr>
                </div>
            </tbody>
            </table>
            <div class="form-group">
                <label for="descricao">Comentários</label>
                <input type="text" name="texto_resposta" class="form-control" id="texto_resposta">
            </div>
            <button type="submit" class="btn btn-outline-success mb-4">Enviar Respostas</button>
            <div class="progress mt-4">
                <div class="progress-bar" role="progressbar" style="width: {{$progresso}}%;" aria-valuenow="{{$progresso}}" aria-valuemin="0" aria-valuemax="100">{{$qtd}}</div>
            </div>
    </div>
</div>

@endsection