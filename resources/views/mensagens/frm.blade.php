@extends('template.template')
@section('content')

<body>
    <div class="container">
        <div class="container espacamento">
            <form id="uploadForm" action="{{url('mensagens/'.$mensagem->id )}}" method="POST" enctype="form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="campanha_id" value="{{$mensagem->campanha->id}}">
                <div class="form-group mt-3">
                    <textarea name="texto_mensagem" id="editor">
                    {{ $mensagem->texto_mensagem ?? '' }}
                    </textarea>

                </div>
                <div class="form-group mt-3">
                    <label>Tipo de Mensagem</label>
                    <input class="form-control input-sm" type="text" value="{{ $mensagem->tipoMensagem->tipo }}" disabled>

                </div>
                <div class=" mt-3">
                    <button class="btn btn-success" onclick="">
                        <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                        Salvar </button>
                    <button type="button" class="btn btn-warning" onclick="window.location='{{url('mensagens/'.$mensagem->campanha->id )}}' ">
                        <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                        Voltar </button>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection
@section('scripts')
<script>
    window.onload = function() {
        CKEDITOR.replace('editor')
    }
</script>
@endsection