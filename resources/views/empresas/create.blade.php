@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h4 class="tituloPrincipal">Dados da Empresa</h4>
                        </div>
                            <form action="/dados" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" name="nome" class="form-control" id="nome" required>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col-sm">
                                        <label>DNS</label>
                                        <input type="text" name="dns" id="dns" class="form-control" required>
                                    </div>
                                </div>


                                <button class="btn btn-success" onclick="alertaSalvar()">
                                    <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                </button>
                                <button type="button" class="btn btn-warning" onclick="window.location = '/dados'">
                                    <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                                </button>
                                <button type="button" class="btn btn-danger" onclick="confirmaDelete()">
                                    <img src=" {{ asset('img/007-excluir.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                </button>
                                <hr>
                                <input type="submit" class="btn btn-outline-success mb-4" value="Atualizar dados do cliente">
                            </form>

                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection