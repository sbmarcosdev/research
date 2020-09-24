@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <a class="mb-4">Perguntas</a> |
        <a class="mb-4">Campanha {{ $campanha -> descricao }}</a>
        <hr>
        <a href="/campanhas">
            <button type="button" class="btn btn-outline-info mb-4">Voltar</button>
        </a>
        <a href="/perguntas/{{ $campanha -> id }}/create">
            <button type="button" class="btn btn-outline-success mb-4">Incluir Nova Pergunta</button>
        </a>



        <table id=" table" name="table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Pergunta</th>
                    <th>Tipo</th>
                    <th>Ordem de Exibição</th>
                    <th>Ação</th>
                </tr>
            </thead>


            <tbody>
                @forelse($perguntas as $perg)
                <tr>
                    <td>{{ $perg->texto}}</td>
                    <td>{{ $perg->tipo->tipo}}</td>
                    <td>{{ $perg->ordem}}</td>
                    <td><a href='/perguntas/{{$perg->id}}/edit'>Editar </a> </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>

        @if($campanha->temPerguntas)
        <a>
            <button type="button" class="btn btn-outline-info mb-4" onclick="window.location = '/importar/{{ $campanha->id }}'">Participantes</button>
        </a>
        @endif
        
    </div>
</div>
@endsection