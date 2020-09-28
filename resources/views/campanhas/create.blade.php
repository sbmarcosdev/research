@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h4 class="tituloPrincipal">Dados da Campanha</h4>
                        </div>
                        <form action="/campanhas" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nome">Descrição</label>
                                <input type="text" name="descricao" class="form-control" id="descricao" required>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-sm">
                                    <label>Data de Início</label>
                                    <input type="date" name="data_inicio" id="data_inicio" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-sm">
                                    <label>Data de Término</label>
                                    <input type="date" name="data_termino" id="data_termino" class="form-control" required>
                                </div>
                            </div>

                            <button class="btn btn-success" onclick="alertaSalvar()">
                                Salvar
                            </button>
                            <button type="button" class="btn btn-warning" onclick="window.location='{{url('/campanhas')}}'">
                                Voltar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection