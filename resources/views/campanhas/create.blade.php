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
                        <form action="{{url('/campanhas')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nome">Descrição</label>
                                <input type="text" name="descricao" class="form-control" id="descricao" required>
                            </div>
                            <div class="form-group">
                                <label for="nome">Empresa</label>
                                <select class="form-control" name="empresa_id" required>
                                    @foreach($empresas as $empresa)
                                    <option value="{{$empresa->id}}">{{ $empresa->nome }}</option>
                                    @endforeach
                                </select>
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

                            <button class="btn btn-success">
                                <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Incluir">
                                Salvar
                            </button>
                            <button type="button" class="btn btn-warning" onclick="window.location='{{url('campanhas')}}'">
                                <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
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

@section('scripts')
<script>
    $('form').on("submit", function(event) {

        if (($('#descricao').val().length == 0)) {
            event.preventDefault();
            $('#descricao').tooltip('show');


        } else if ($('#descricao').val().length == 0) {
            event.stopPropagation();
            $('#descricao').tooltip('show');

        } else if ($('#descricao').val().length == 0) {
            event.stopPropagation();
            $('#descricao').tooltip('show');
        }
    });
</script>
@endsection