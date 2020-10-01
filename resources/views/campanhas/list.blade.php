@extends('template.template')
@section('content')


<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h4 class="tituloPrincipal">Campanhas</h4>
                        </div>


                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Validade</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($campanhas as $camp)
                                <tr>
                                    <td>{{$camp->empresa->nome}}</td>
                                    <td>{{$camp->descricao}}</td>
                                    <td>{{date('d/m/Y', strtotime($camp->data_termino)) }}</td>
                                    <td>
                                        @if($camp->status == '1')
                                        <a>Ativa</a>
                                        @else
                                        <a>Inativa</a>
                                        @endif
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-info" onclick="window.location='{{url('/campanhas/'.$camp->id.'/edit')}}'">
                                            <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                        </button>
                                        <form action="" method="POST" onsubmit="return confirm('{{ trans('Confirma Exclusão?') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="campanha_id" value="{{ $camp->id ?? '' }}">
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

                        <button class="btn btn-success" onclick="window.location='{{url('/campanhas/create')}}'">
                            <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Nova">
                            Incluir </button>
                        <button type="button" class="btn btn-warning" onclick="window.history.back()">
                            <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
                            Voltar </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection