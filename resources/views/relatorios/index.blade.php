@extends('template.template')
@section('content')


<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">

                            <h4>Relatórios Respostas</h4>

                            <input type="button" value="Voltar" onClick='window.history.back()'>
                            <hr>
                        </div>
                        <table class="table table-striped" style="width: 100%; margin: 0 auto;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Participantes Convidados</th>
                                    <th scope="col">Pesquisas Respondidas</th>
                                    <th scope="col" style="width: 80px;">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rel as $camp)
                                <tr>
                                    <td>{{ $camp->id }}</td>
                                    <td>{{ $camp->descricao }}</td>
                                    <td>{{ $camp->campanhaRespondente->count() }} </td>
                                    <td>{{ $camp->campanhaRespondente->where('respondida', 'S')->count() }} </td>
                                    <th><a href="/relatorios/{{$camp->id}}" class="btn btn-xs btn-info pull-right">Ver Detalhes</a></th>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection