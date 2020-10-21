@extends('template.template')
@section('content')
<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h5>{{$respostas->first()->respondente->nome}} </h5>

                            <table class="table table-striped" style="width: 100%; margin: 0 auto;">
                                <thead>
                                    <tr>
                                        <th>Perguntas</th>
                                        <th>Opção</th>
                                        <th>Respostas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $respostas as $resposta )
                                    <tr>
                                        <td>{!! $resposta->pergunta->texto ?? '' !!}</td>
                                        <td>{!! $resposta->opcaoResposta->titulo ?? '' !!}
                                            @if($resposta->tipo_id == 4)
                                                @foreach ( $respostasOpcao as $opcao)
                                                    {!! $opcao->opcaoResposta->titulo ?? '' !!}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{!! $resposta->texto_resposta ?? '' !!}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <button type="button" class="btn btn-warning" onclick="window.location = '{{url('/importar/'.$respostas->first()->campanha_id)}}'">
                                <img src="{{ asset('img/009-voltar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                                Voltar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection