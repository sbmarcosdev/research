@extends('template.resp_template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <h4 class="tituloPrincipal">{{ $resp->campanha->descricao }}</h4>

        <h5 class="mb-4"> {{ $resp->respondente->nome }}</h5>

        <form action="{{url('/resposta')}}" method="POST" autocomplete="off">
            @csrf
            @method('patch')

            <input type="hidden" name="sim_nao">
            <input type="hidden" name="pergunta_id" value="{{$pergunta->id}}">
            <input type="hidden" name="tipo_id" value="{{$pergunta->tipo_id}}">

            <h4> {!! $pergunta->texto !!} </h4>

            <table id="rtable" name="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        @forelse($multipla as $opcao)
                        <th>{!! $opcao->titulo !!} </th>
                        @empty
                        @endforelse
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        @forelse($multipla as $opcao)
                        <td><input type="checkbox" name="opcao_id[{{ $opcao->id }}]"> </td>
                        <input type="hidden" name="peso_opcao" value="{{$opcao->peso}}">
                        @empty
                        @endforelse
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