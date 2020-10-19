@extends('template.resp_template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <h4 class="tituloPrincipal">Campanha {{ $resp->campanha->descricao }}</h4>

        <h5 class="titulosub"> {{ $resp->respondente->nome }}</h5>

        <form action="{{url('/resposta')}}" method="POST" autocomplete="off">
            @csrf
            @method('patch')

            <input type="hidden" name="sim_nao">
            <input type="hidden" name="pergunta_id" value="{{$pergunta->id}}">
            <input type="hidden" name="tipo_id" value="{{$pergunta->tipo_id}}">

            <h5 class="mt-2"> {!! $pergunta->texto !!}</h5>

            <a class="mt-2"> {{ $pergunta->texto_ajuda }} <a>

                    <table id="rtable" name="table" class="table table-striped table-bordered mt-2" style="width:100%">
                        <thead>
                            <tr>
                                @forelse($opcoes as $opcao)
                                <th>{!! $opcao->titulo !!} </th>
                                @empty
                                @endforelse
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                @forelse($opcoes as $opcao)
                                <td>
                                    <div class="radio"><input type="radio" name="peso_resposta" value="{{ $opcao->peso }}" required>
                                </td>

                                @empty
                                @endforelse
                            </tr>
                        </tbody>
                    </table>

                    @if($pergunta->opcao_justificativa)
                    <div class="form-group">
                        <label for="descricao">{{ $pergunta->titulo_justificativa ?? 'Comentários' }}</label>
                        <input type="text" name="texto_resposta" class="form-control" id="texto_resposta">
                    </div>
                    @endif
                    
                    <div class="tituloPrincipal mt-3">
                        <button type="submit" class="btn btn-outline-info mb-4">Enviar Respostas</button>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{$progresso}}%;" aria-valuenow="{{$progresso}}" aria-valuemin="0" aria-valuemax="100">{{$qtd}}</div>
                    </div>
    </div>
</div>

@endsection