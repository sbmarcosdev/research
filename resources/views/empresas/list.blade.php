@extends('template.template')
@section('content')


<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h4 class="tituloPrincipal">Empresas</h4>
                        </div>
                        <table class="table table-striped" style="width: 100%; margin: 0 auto;">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Razão Social</th>
                                    <th>Link de Acesso</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($empresas as $emp)
                                <tr>
                                    <td>{{$emp->id ?? ''}}</td>
                                    <td>{{$emp->nome ?? ''}}</td>
                                    <td>{{$emp->link_acesso ?? ''}}</td>
                                    <th>
                                        <button type="button" class="btn btn-info" onclick="window.location='{{url('empresas/'.$emp->id.'/edit')}}'">
                                            <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                        </button>

                                        <form action="{{url('empresas/'.$emp->id)}}" method="POST" onsubmit="return confirm('{{ trans('Confirma Exclusão?') }}');" style="display: inline-block;">
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $emp->id ?? '' }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger">
                                                <img src="{{ asset('img/007-excluir.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                            </button>
                                        </form>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <hr>

                        <button class="btn btn-success" onclick="window.location='{{url('empresas/create')}}' ">
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