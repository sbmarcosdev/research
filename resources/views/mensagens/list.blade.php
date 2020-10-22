@extends('template.template')
@section('content')
<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h4 class="tituloPrincipal"> Mensagens </h4>

                            <table class="table table-striped" style="width: 100%; margin: 0 auto;">
                                <thead>
                                    <tr>
                                        <th> Tipo Mensagem </th>
                                        <th> Ação </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mensagens as $mensagem)
                                    <tr>
                                        <td>{{ $mensagem->tipoMensagem->tipo }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info" onclick="window.location='{{url('/mensagens/'.$mensagem->id.'/edit')}}'">
                                                <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                            </button>
                                            <form action="{{url('mensagens/'.$mensagem->id)}}" method="POST" onsubmit="return confirm('{{ trans('Confirma Exclusão?') }}');" style="display: inline-block;">
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $mensagem->id ?? '' }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-danger">
                                                    <img src="{{ asset('img/007-excluir.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <hr>

                            <button class="btn btn-success" onclick="window.location='{{url('mensagens/incluir/'.$campanha_id)}}'">
                                <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Novo">
                                Incluir </button>
                            <button type="button" class="btn btn-secondary" onclick="window.location='{{url('/campanhas/'.$campanha_id.'/edit/' )}}'">
                                <img src="{{ asset('img/009-voltar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                                Voltar </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection