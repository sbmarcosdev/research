@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <form action="/salvar_opcoes" method="POST">
            @csrf
            @method('post')

            <input type="text" name="pergunta_id" value="40">
            <input type="text" name="opcao_resposta_id" value="27">

            <input type="submit">

        </form>
    </div>
</div>

@endsection