@extends('template.template_login')
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
                            <a>Acesse a Plataforma de Pesquisas com as credenciais da rede</a>
                            <hr>

                            <form id="uploadForm" action="{{url('/login-ad')}}" method="POST" enctype="form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="descricao">E-mail</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="descricao">Senha</label>
                                    <input type="password" name="senha" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-success">

                                    Login </button>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection