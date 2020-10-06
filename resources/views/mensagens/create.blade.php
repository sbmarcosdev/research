@extends('template.template')
@section('content')

<body onload="jsEditor()">
    <div class="container">
        <div class="container espacamento">
            <form id="uploadForm" action="{{url('mensagens')}}" method="POST" enctype="form-data">
                @csrf
                @method('POST')

                <textarea name="texto_mensagem" id="editor">

                </textarea>
                <div class="form-row mt-3 mb-3">
                    <div class="col-sm">
                        <label>Tipo de Mensagem</label>
                        <select class="form-control" name="tipo_mensagem_id" required>
                            <option id="op1" value="1">Texto E-mail Marketing Digital</option>
                            <option id="op2" value="2">Boas Vindas </option>
                            <option id="op3" value="3">Campanha Não Iniciada</option>
                            <option id="op4" value="4">Campanha Finalizada com Sucesso </option>
                            <option id="op5" value="5">Campanha Expirada </option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="campanha_id" value="{{$campanha_id}}">
                <button class="btn btn-success" onclick="">
                    <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                    Salvar </button>
                <button type="button" class="btn btn-warning" onclick="window.location='{{url('mensagens/'.$campanha_id )}}' ">
                    <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                    Voltar </button>
            </form>
        </div>
    </div>
</body>
@endsection