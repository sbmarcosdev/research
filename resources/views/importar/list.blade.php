@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <a class="mb-4">Participantes | </a>
        <a class="mb-4">Campanha {{ $campanha->descricao ?? ''}} </a>
        <hr>
        <a href="{{url('/importar/'.$campanha->id ?? '') }}/edit">
            <button type="button" class="btn btn-outline-success mb-4">Importar Dados</button></a>
        <a href="{{url('/campanhas')}}"><button type="button" class="btn btn-outline-info mb-4">Voltar</button></a>

        <table id="table" name="table" class="table table-striped table-bordered">
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
@endsection