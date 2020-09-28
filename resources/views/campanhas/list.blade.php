@extends('template.template')
@section('content')


<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h4>Campanhas - Pesquisa de Satisfação</h4>
                        </div>


                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Validade</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($campanhas as $camp)
                                <tr>
                                    <td>{{$camp->id}}</td>
                                    <td>{{$camp->descricao}}</td>
                                    <td>{{date('d/m/Y', strtotime($camp->data_termino)) }}</td>
                                    <td>
                                        @if($camp->status == '1')
                                        <a>Ativa</a>
                                        @else
                                        <a>Inativa</a>
                                        @endif
                                    </td>

                                    <td><a href="{{url('/campanhas/'.$camp->id.'/edit')}}" class="btn btn-xs btn-info pull-right">Selecionar</a>
                                        <a>
                                            <form action="" method="POST" onsubmit="return confirm('{{ trans('Confirma Exclusão?') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="campanha_id" value="{{ $camp->id ?? '' }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="X" title="Excluir">
                                            </form>
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <hr>

                        <button class="btn btn-success" onclick="window.location='{{url('/campanhas/create')}}'">
                            Incluir </button>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection