@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h4 class="tituloPrincipal">Participantes</h4>

                            <div class="form group mt-3">

                                <button type="button" class="btn btn-info" onclick="window.location='{{ url('/importar/' .$campanha->id. '/edit/' )}}' ">
                                    <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
                                    Importar </button>

                                <button type="button" class="btn btn-info" onclick="window.location='{{ url('/arquivo/' .$campanha->id )}}' ">
                                    <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Arquivo">
                                    Gerar Arquivo </button>

                                <button type="button" class="btn btn-warning" onclick="window.location='{{ url('/campanhas/' .$campanha->id. '/edit/' )}}' ">
                                    <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
                                    Voltar </button>

                            </div>

                            <table id="table" name="table" class="table table-striped table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>E-Mail</th>
                                        <th>Respostas</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pesq as $resp)
                                    <tr>
                                        <td>{{ $resp->respondente->nome }}</td>
                                        <td>{{ $resp->respondente->email }}</td>
                                        <td>{{ count($resp->status->where('respondida','S')) }} / {{ count($resp->status) }}</td>
                                        <td>
                                            @if($resp->status->where('respondida','S')->first())
                                            <button type="button" class="btn btn-info" onclick="window.location='{{url('/relatorios/'.$pesq->first()->campanha->id )}}/{{ $resp->respondente->id}}'">
                                                <img src="{{ asset('img/grafico.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Ver Respostas">
                                            </button>
                                            @endif    
                                            <form action="" method="POST" onsubmit="return confirm('{{ trans('Confirma Exclusão?') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="campanha_respondente_id" value="{{ $resp->id ?? '' }}">
                                                <input type="hidden" name="campanha_id" value="{{ $pesq->first()->campanha->id ?? '' }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button class="btn btn-danger">
                                                    <img src="{{ asset('img/007-excluir.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection