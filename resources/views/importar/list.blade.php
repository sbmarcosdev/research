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

                                <button type="button" class="btn btn-warning" onclick="window.history.back()">
                                    <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
                                    Voltar </button>

                            </div>

                            <table id="table" name="table" class="table table-striped table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>E-Mail</th>
                                        <th>Respostas</th>
                                        <th>Link</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pesq as $resp)
                                    <tr>
                                        <td>{{ $resp->respondente->nome }}</td>
                                        <td>{{ $resp->respondente->email }}</td>
                                        <td>{{ count($resp->status->where('respondida','S')) }} / {{ count($resp->status) }}</td>
                                        <td><a href="{{url('/responder/'.$pesq->first()->campanha->id) }}/{{ $resp->respondente->id}}"> Link </a></td>
                                        <td>
                                            @if($resp->status->where('respondida','S')->first())
                                            <a href="{{url('/relatorios/'.$pesq->first()->campanha->id )}}/{{ $resp->respondente->id}}" title="Visualizar Respostas"> Ver </a>
                                            @else
                                            <a href="" title="Excluir Participante"> </a>

                                            <form action="" method="POST" onsubmit="return confirm('{{ trans('Confirma Exclusão?') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="campanha_respondente_id" value="{{ $resp->id ?? '' }}">
                                                <input type="hidden" name="campanha_id" value="{{ $pesq->first()->campanha->id ?? '' }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="X" title="Excluir">
                                            </form>

                                            @endif
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