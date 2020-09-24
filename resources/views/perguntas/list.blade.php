@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 490px">
                        <a class="mb-4">Perguntas</a> |
                        <a class="mb-4">Campanha {{ $campanha -> descricao }}</a>
                        <hr>
                        <a href="/campanhas">
                            <button type="button" class="btn btn-outline-info mb-4">Voltar</button>
                        </a>
                        <a href="/perguntas/{{ $campanha -> id }}/create">
                            <button type="button" class="btn btn-outline-success mb-4">Incluir Nova Pergunta</button>
                        </a>

                        <table id="table" name="table" class="table table-striped table-bordered">

                            <tbody data-id="{{ $campanha->id }}" class="sortable">
                                <tr>
                                    <td colspan="8" style="background-color:#ddd;">{{ $campanha->descricao }}</td>
                                </tr>

                                <th>Pergunta</th>
                                <th>Tipo</th>
                                <th>Ordem</th>
                                <th>Ação</th>
                                @foreach($perguntas as $perg)
                                <tr data-id="{{ $perg->id ?? '' }}" class="pergunta" title="Arraste para ordenar">

                                    <td>
                                        {{ $perg->texto ?? '' }}
                                    </td>
                                    <td class="category-name">
                                        {{ $perg->campanha->descricao ?? '' }}
                                    </td>

                                    <td class="position">
                                        <a>{{ $perg->ordem ?? '' }}</a>
                                    </td>

                                    <td>@if ($perg->resposta->first())
                                        <a href='/relatorios/{{$perg->id}}/detalhe' class="btn btn-xs btn-info" title="Ver Respostas">
                                            Ver
                                        </a>
                                        @elseif($perg->status->first())
                                        <a href='/perguntas/{{$perg->id}}/edit' class="btn btn-xs btn-info" title="Editar">
                                            Editar </a>
                                        @else
                                        <a href='/perguntas/{{$perg->id}}/edit' class="btn btn-xs btn-info" title="Editar">
                                            Editar </a>
                                            
                                        <form action="" method="POST" onsubmit="return confirm('{{ trans('Confirma Exclusão?') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="pergunta_id" value="{{ $perg->id ?? '' }}">
                                            <input type="hidden" name="campanha_id" value="{{ $perg->campanha->id ?? '' }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="X" title="Excluir">
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                        @if($campanha->temPerguntas)
                        <a>
                            <button type="button" class="btn btn-outline-info mb-4" onclick="window.location = '/importar/{{ $campanha->id }}'">Participantes</button>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    function sendReorderPerguntasRequest($category) {
        var items = $category.sortable('toArray', {
            attribute: 'data-id'
        });
        var ids = $.grep(items, (item) => item !== "");

        if ($category.find('tr.pergunta').length) {
            $category.find('.empty-message').hide();
        }
        $category.find('.category-name').text($category.find('tr:first td').text());

        $.post("{{ route('admin.perguntas.reorder') }}", {
                _token,
                ids,
                category_id: $category.data('id')
            })
            .done(function(response) {
                $category.children('tr.pergunta').each(function(index, pergunta) {
                    $(pergunta).children('.position').text(response.positions[$(pergunta).data('id')])
                });
            })
            .fail(function(response) {
                alert('Error occured while sending reorder request');
                location.reload();
            });
    }

    $(document).ready(function() {
        var $categories = $('table');
        var $perguntas = $('.sortable');

        $perguntas.sortable({
            connectWith: '.sortable',
            items: 'tr.pergunta',
            stop: (event, ui) => {
                sendReorderPerguntasRequest($(ui.item).parent());

                if ($(event.target).data('id') != $(ui.item).parent().data('id')) {
                    if ($(event.target).find('tr.pergunta').length) {
                        sendReorderPerguntasRequest($(event.target));
                        console.log($(event.target));
                    } else {
                        $(event.target).find('.empty-message').show();
                    }
                }
            }
        });
        $('table, .sortable').disableSelection();
    });
</script>
@endsection