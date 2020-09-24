@extends('template.template')
@section('content')


<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h1 class="tituloPrincipal">Empresas</h1>
                        </div>
                        <table class="table table-striped" style="width: 100%; margin: 0 auto;">
                            <thead>
                                <tr>
                                    <th colspan="4">Selecione a Empresa</th>

                                    <th><button class="btn btn-success" onclick="window.location='/empresas/create'"> <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Incluir">
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">DNS</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col" style="width: 80px;">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($empresas as $emp)
                                <tr>
                                    <td>{{$emp->id}}</td>
                                    <td>{{$emp->nome}}</td>
                                    <td>{{$emp->dns}}</td>

                                    <td>
                                        @if($emp->logo != '')
                                        <img src="{{$emp->logo}}" width="50" style="filter: brightness(0.5) sepia(0) hue-rotate(-70deg) saturate(5);">
                                        @endif

                                    </td>

                                    <th><a href="/empresas/{{$emp->id}}/edit" class="btn btn-xs btn-info pull-right">Edit</a></th>
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