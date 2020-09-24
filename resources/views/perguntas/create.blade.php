@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <a>Cadastrar Perguntas | </a>

                            <a>Campanha {{ $campanha -> descricao }}</a>
                            <hr>
                        </div>
                        <form action="/perguntas" method="POST">
                            @csrf
                            @method('post')

                            <input type="hidden" name="campanha_id" id="campanha_id" value="{{ $campanha->id }}">

                            <div class="form-group">
                                <label for="descricao">Pergunta</label>
                                <input type="text" name="texto" class="form-control" id="texto" required>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-sm">
                                    <label>Tipo de Resposta</label>
                                    <select class="form-control" name="tipo_id" id="status" required onchange="jsSelect()">
                                        <option id="op1" value="1">Classificatória | Ótimo | Bom | Regular | Ruim | Péssimo | </option>
                                        <option id="op2" value="2">Opção Numérica | 1 | 2 | 3 | 4 | 5 |</option>
                                        <option id="op3" value="3">Afirmativa | Sim | Não |</option>
                                        <option id="op4" value="4">Múltipla Escolha | Check Box |</option>
                                        <option id="op5" value="5">Descritiva | Texto |</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-sm">
                                    <label>Ordem</label>
                                    <input type="text" name="ordem" id="ordem" class="form-control" value="{{$campanha->numNova}}">
                                </div>
                            </div>
                            <button class="btn btn-success" onclick="alertaSalvar()">
                                Salvar
                            </button>

                            <button type="button" class="btn btn-warning" onclick="window.location = '/perguntas/{{$campanha->id}}'">
                                <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                                Voltar
                            </button>
                    </div>
                </div>
                </form>

                <div class="modal fade" id="modalOpcoes" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Múltipla Escolha</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/salvar_opcoes" method="POST">
                                <div class="modal-body">

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Opção Personalizada">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <a href="#" onclick="salvaOpcao()">Incluir</a>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-row mb-3">
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
                                                    <td><input type="checkbox"> </td>
                                                </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-outline-secondary" value="Selecionar">
                            </form>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Voltar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script>
    function salvaOpcao() {

        var titulo = $('#titulo').val();
        var tipo_id = 4;
        var peso = 1;
        var ordem = 9;

        $.post("{{ route('opcoes') }}", {
                _token,
                titulo,
                tipo_id,
                peso,
                ordem
            })
            .done(function(response) {

                var newRow = $("<tr>");
                var cols = "";

                cols += '<td>' + response.positions.titulo + '</td>';
                cols += '<td>';
                cols += '<input type="checkbox">';
                cols += '</td>';
                newRow.append(cols);
                $("#tabelaOpcao").append(newRow);
            })
            .fail(function(response) {
                alert('Error occured while sending reorder request');
                location.reload();
            });
    }
</script>
@endsection