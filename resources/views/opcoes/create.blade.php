@extends('template.template')
@section('content')
<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h5>{!! $pergunta->texto !!} </h5>

                        </div>
                        <form action="{{url('/opcoes')}}" method="POST">
                            @csrf
                            @method('post')

                            <input type="hidden" name="pergunta_id" value="{{ $pergunta->id }}">
                            <input type="hidden" name="tipo_id" value="{{ $pergunta->tipo_id }}">

                            <textarea name="titulo" id="editor"></textarea>

                            <div class="form-row mb-3">
                                <div class="col form-group mt-2 mr-2">
                                    <label>Peso Resposta</label>
                                    <input type="number" min="0" max="99" name="peso" id="ordem" class="form-control" value="1" required>
                                </div>
                                <div class="col form-group mt-2 mr-2">
                                    <label>Ordem</label>
                                    <input type="number" min="0" max="99" name="ordem" id="ordem" class="form-control" value="{{$maxValue ?? ''}}">
                                </div>
                            </div>
                            <button class="btn btn-success">
                                <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                                Salvar
                            </button>

                            <button type="button" class="btn btn-warning" onclick="window.location = '{{url('/opcoes/'.$pergunta->id)}}'">
                                <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                                Voltar
                            </button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    window.onload = function() {
        CKEDITOR.replace('editor')
    }
</script>
@endsection