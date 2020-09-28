@extends('template.template')
@section('content')


<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <a>Editar Perguntas | </a>

                            <a>Campanha {{ $pergunta->campanha->descricao }}</a>
                            <hr>
                        </div>

                        <body onload="jsOption('{{$pergunta->tipo_id}}')">

                            <form action="/perguntas/{{$pergunta->id}}" method="POST">
                                @csrf
                                @method('patch')

                                <input type="hidden" name="id" id="campo_id" value="{{ $pergunta->id }}">

                                <input type="hidden" name="campanha_id" id="campanha_id" value="{{ $pergunta->campanha_id }}">

                                <div class="form-group">
                                    <label for="descricao">Pergunta</label>
                                    <input type="text" name="texto" class="form-control" id="texto" value="{{ $pergunta->texto }}" required>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="col-sm">
                                        <label>Tipo de Resposta</label>
                                        <select class="form-control" name="tipo_id" id="status" required>
                                            <option id="op1" value="1">Classificatória | Ótimo | Bom | Regular | Ruim | Péssimo | </option>
                                            <option id="op2" value="2">Opção Numérica | 1 | 2 | 3 | 4 | 5 |</option>
                                            <option id="op3" value="3">Afirmativa | Sim | Não |</option>
                                            <option id="op4" value="4">Múltipla Escolha | Check Box |</option>
                                            <option id="op5" value="5">Descritiva | Texto |</option>
                                            <option id="op6" value="6">Opções Personalizadas </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col-sm">
                                        <label>Ordem</label>
                                        <input type="text" name="ordem" id="ordem" class="form-control" value="{{ $pergunta->ordem }}">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    Salvar
                                </button>

                                <button type="button" class="btn btn-warning" onclick="window.location = '/perguntas/{{$pergunta->campanha->id}}'">
                                    <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                                    Voltar </button>
                                <button type="button" class="btn btn-danger" onclick="jsDelete_Token()">
                                    <img src=" {{ asset('img/007-excluir.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                    Excluir </button>
                                <hr>
                                @if($pergunta->ordem == '1')
                                <input type="button" class="btn btn-outline-success mb-4" value="Escolher Tipo de Resposta" onclick="window.location = '/perguntas/{{ $pergunta->campanha_id }}'">
                                @endif
                            </form>
                        </body>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection