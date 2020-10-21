@extends('template.template')
@section('content')
<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h4 class="tituloPrincipal"> Administradores </h4>

                            <table class="table table-striped" style="width: 100%; margin: 0 auto;">
                                <thead>
                                    <tr>
                                        <th> Login Usuário </th>
                                        <th> Ação </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logins as $login)
                                    <tr>
                                        <td>{{ $login->nome }}</td>
                                        <td>
                                            <form action="{{url('exclusao-usuarios')}}" method="POST" onsubmit="return confirm('{{ trans('Confirma Exclusão?') }}');" style="display: inline-block;">
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $login->id ?? '' }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-xs btn-danger">
                                                    <img src="{{ asset('img/007-excluir.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <hr>

                            <button class="btn btn-success" onclick="window.location = '{{url('/usuarios/create')}}'">
                                <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Novo">
                                Incluir </button>
                            <button type="button" class="btn btn-warning" onclick="window.history.back()">
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