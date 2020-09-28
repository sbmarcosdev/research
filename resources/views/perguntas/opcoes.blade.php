@extends('template.template')
@section('content')
<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h5 class="modal-title">Opções de Respostas Personalizadas</h5>
                            <hr>
                            <a>{{ $pergunta->campanha->descricao }}</a> | Pergunta | <a>{{ $pergunta->texto }} </a>
                            <hr>
                            <form action="/salvar_opcoes" method="POST">
                                @csrf
                                @method('post')

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Opção Personalizada">

                                    <input type="hidden" name="pergunta_id" value="{{ $pergunta->id }}">
                                    <input type="hidden" name="campanha_id" value="{{ $pergunta->campanha_id }}">

                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <a href="#" onclick="salvaOpcao()">Incluir</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="checkbox-group required" onclick="check()">
                                        <table id="tabelaOpcao" name="table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Opção</th>
                                                    <th>Selecionar</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @forelse($opcoes as $opcao)
                                                <tr>
                                                    <td>{{$opcao->titulo}}</td>
                                                    <td><input type="checkbox" name="opcao_resposta_id[{{$opcao->id}}]" value="{{$opcao->id}}"> </td>
                                                </tr>
                                                @empty
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div>
                                    <input type="submit" id="btnSelect" class="btn btn-outline-secondary" value="Selecionar" disabled>
                            </form>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onClick='window.history.back()'>Voltar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
        function check() {
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
                $("#btnSelect")
                    .removeClass("btn btn-outline-secondary")
                    .addClass("btn btn-info")
                    .prop("disabled", false);
            } else {
                $("#btnSelect")
                    .removeClass("btn btn-info")
                    .addClass("btn btn-outline-secondary")
                    .prop("disabled", true);
            }

        }

        function salvaOpcao() {

            var titulo = $('#titulo').val();
            var tipo_id = 6;
            var peso = 1;
            var ordem = 99;

            $.post("{{ route('opcoes') }}", {
                    _token,
                    titulo,
                    tipo_id,
                    peso,
                    ordem
                })
                .done(function(response) {

                    location.reload();
                })
                .fail(function(response) {
                    alert('Error occured while sending reorder request');
                    location.reload();
                });
        }
    </script>
    @endsection