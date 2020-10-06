@extends('template.template')
@section('content')

<body onload="jsEditor()">
    <div class="container">
        <div class="container espacamento">
            <form id="uploadForm" action="{{url('mensagens/'.$mensagem->id )}}" method="POST" enctype="form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="campanha_id" value="{{$mensagem->campanha->id}}">
                 <textarea name="texto_mensagem" id="editor">
                {{ $mensagem->texto_mensagem ?? '' }}
                </textarea>
                <div class="form-row mt-3 mb-3">
                    <div class="col-sm">
                        <label>Tipo de Mensagem</label>
                        <input type="text" value="{{ $mensagem->tipoMensagem->tipo }}" disabled>
                    </div>
                </div>
                <hr>
                <button class="btn btn-success" onclick="">
                    <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                    Salvar </button>
                <button type="button" class="btn btn-warning" onclick="window.location='{{url('mensagens/'.$mensagem->campanha->id )}}' ">
                    <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                    Voltar </button>
            </form>
        </div>
    </div>
</body>
@endsection