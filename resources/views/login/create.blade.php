@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 360px">
                        <div class="col-sm-12">
                            <h4>Login Usuário</h4>
                            <hr>
                            <a>Adicione as credenciais para administração do sistema</a>
                            <hr>

                            <form id="uploadForm" action="{{url('/usuarios')}}" method="POST" enctype="form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="descricao">E-mail</label>
                                    <input type="email" name="nome" class="form-control" required>
                                </div>

                                <hr>

                                <button class="btn btn-success" onclick="">
                                    <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                    Salvar </button>
                                <button type="button" class="btn btn-warning" onclick="window.location = '{{url('/usuarios')}}'">
                                    <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                                    Voltar </button>


                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection