@extends('template.template_login')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 360px">
                        <div class="col-sm-12">
                            <h4> @if(isset($resp->campanha->descricao )) {{ $resp->campanha->descricao }} @endif</h4>
                            <hr>
                            <h4> {{ $erro['erro'] }}</h4>
                        </div>
                        <button type="button" class="btn btn-warning" onclick="window.history.back()">
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