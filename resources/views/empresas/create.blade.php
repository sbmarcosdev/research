@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 480px">
                        <div class="col-sm-12">
                            <h4 class="tituloPrincipal">Dados da Empresa</h4>
                            <div id="targetLayer" style="position: absolute; top: 0; right: 0; height: 60px"></div>
                            <hr>

                            <form id="uploadForm" action="{{url('/empresas')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Razão Social</span>
                                        </div>
                                        <input type="text" name="nome" class="form-control">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Link de Acesso</span>
                                        </div>
                                        <input type="text" name="link_acesso" class="form-control">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cor Primária</span>
                                        </div>
                                        <input type="text" name="cor_primaria" class="form-control">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cor Secundária</span>
                                        </div>
                                        <input type="text" name="cor_secundaria" class="form-control">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cor Topo Rodapé</span>
                                        </div>
                                        <input type="text" name="cor_topo_rodape" class="form-control">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Logotipo</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="logo" onChange="showPreview(this)">
                                            <label class="custom-file-label" for="inputGroupFile01">
                                                <div id="div_arquivo_logo"> </div>
                                            </label>

                                        </div>

                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Banner</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="banner" onChange="jsBannerPreview(this)">
                                            <label class="custom-file-label" for="inputGroupFile01">
                                                <div id="div_arquivo_banner"> </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div id="div_banner" style="position: absolute; right: 0; height: 40px"> </div>
                                    </div>
                                    <button class="btn btn-success" onclick="">
                                        <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                        Salvar </button>
                                    <button type="button" class="btn btn-warning" onclick="window.location = '{{url('/empresas')}}'">
                                        <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                                        Voltar </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection