@extends('template.template')
@section('content')


<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h5 class="tituloPrincipal">Editar Perguntas </h5>
                        </div>

                        <body>

                            <form action="{{url('/perguntas/'.$pergunta->id)}}" method="POST">
                                @csrf
                                @method('patch')

                                <input type="hidden" name="id" id="campo_id" value="{{ $pergunta->id }}">

                                <input type="hidden" name="campanha_id" id="campanha_id" value="{{ $pergunta->campanha_id }}">

                                <textarea name="texto" id="editor" required>{{ $pergunta->texto }}</textarea>

                                <div class="form-row mb-3">
                                    <div class="col form-group mt-2 mr-2">
                                        <label for="descricao">Texto de Ajuda</label>
                                        <input type="text" name="texto_ajuda" class="form-control" id="texto" value="{{ $pergunta->texto_ajuda}}">
                                    </div>

                                    <div class="col form-group mt-2 mr-2">
                                        <label>Tipo de Resposta</label>
                                        <select class="form-control" name="tipo_id" id="status" required>
                                            <option id="op1" value="1">Classificatória | Ótimo | Bom | Regular | Ruim | Péssimo | </option>
                                            <option id="op2" value="2">Opção Numérica | 1 | 2 | 3 | 4 | 5 |</option>
                                            <option id="op3" value="3">Afirmativa | Sim | Não |</option>
                                            <option id="op4" value="4">Múltipla Escolha | Check Box | </option>
                                            <option id="op5" value="5">Descritiva | Texto |</option>
                                            <option id="op6" value="6">Opções Personalizadas | Radio | </option>
                                            <option id="op7" value="7">5 Estrelas </option>
                                        </select>
                                    </div>

                                    <div class="col form-group mt-2 mr-2">
                                        <label>Ordem</label>
                                        <input type="text" name="ordem" id="ordem" class="form-control" value="{{ $pergunta->ordem }}">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Opçoes Personalizadas">
                                    Salvar Alterar Opções
                                </button>

                                <button type="button" class="btn btn-warning" onclick="window.location = '{{url('/perguntas/'.$pergunta->campanha->id)}}'">
                                    <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                                    Voltar </button>

                            </form>
                        </body>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.onload = function() {
        CKEDITOR.replace('editor'),
            jsOption('{{$pergunta->tipo_id}}')
    }
</script>