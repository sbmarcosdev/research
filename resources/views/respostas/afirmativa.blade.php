@extends('template.resp_template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" style="min-height: 360px">
                    <div class="col-sm-12">

                        <h4 class="tituloPrincipal">{{ $resp->campanha->descricao }}</h4>
                        <h5 class="mb-4"> {{ $resp->respondente->nome }}</h5>
                        <form action="{{url('/resposta')}}" method="POST">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="tipo_id" value="3">
                            <input type="hidden" name="pergunta_id" value="{{$pergunta->id}}">

                            <h5>{!! $pergunta->texto !!}</h5>
                            <a>{{ $pergunta->texto_ajuda }}</a>

                            <table id="rtable" name="table" class="table table-striped table-bordered mt-4">
                                <thead>
                                    <tr>
                                        @forelse($afirmativa as $opcao)
                                        <th>{!! $opcao->titulo !!} </th>
                                        @empty
                                        @endforelse
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="radio"><input type="radio" name="peso_resposta" value="5" onclick="jsSimNao('S')" required></div>
                                        </td>
                                        <input type="hidden" name="sim_nao" id="sim_nao">
                                        <td>
                                            <div class="radio"><input type="radio" name="peso_resposta" value="1" onclick="jsSimNao('N')" required></div>
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

                    <div class="progress mt-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$progresso}}%;" aria-valuenow="{{$progresso}}" aria-valuemin="0" aria-valuemax="100">{{$qtd}}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection