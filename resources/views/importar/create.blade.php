@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h4 class="tituloPrincipal">Importação</h4>
                        </div>
                        <form id="uploadForm" action="/import/{{$campanha->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class='icon-choose-image'>
                                <input class='inputFile' type='file' name='importar' id='importar' />
                            </div>

                            <hr>

                            <button class="btn btn-success" onclick="alertaSalvar()">
                                <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                            Salvar </button>
                            <button type="button" class="btn btn-warning" onclick="window.location = '/importar/{{$campanha->id}}'">
                                <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                            Voltar </button>
                            <button type="button" class="btn btn-danger" onclick="confirmaDelete()">
                                <img src=" {{ asset('img/007-excluir.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                            Excluir </button>
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