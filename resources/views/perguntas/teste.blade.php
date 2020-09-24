@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <form action="/opcoes" method="POST">
            @csrf
            @method('post')

            <input type="text" name="tipo_id" id="tipo_id" value="4">
            <input type="text" name="titulo" id="titulo" value="Titulo Teste">
            <input type="text" name="peso" id="peso" value="1">
            <input type="text" name="ordem" id="ordem" value="9">
            <input type="submit">

        </form>
    </div>
</div>

@endsection