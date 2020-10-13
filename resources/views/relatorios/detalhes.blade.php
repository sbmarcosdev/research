@extends('template.template')
@section('content')
<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h5> {!! $pergunta->texto !!} </h5>


                            <table class="table table-striped" style="width: 100%; margin: 0 auto;">
                                <thead>
                                    <tr>@foreach($opcoes as $opcao)
                                        <th scope="col">{!! $opcao->titulo !!}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>@foreach($sub as $s)
                                        <td>{{ $s }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>

                            <button type="button" class="btn btn-warning mt-5" onclick="window.history.back()">
                                <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
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