@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 490px">
                        <h4 class="tituloPrincipal">Perguntas</h4>
                        <table id="table" name="table" class="table table-striped table-bordered">
                            <tbody data-id="{{ $campanha->id }}" class="sortable">
                                <tr>
                                    <th colspan="8" style="background-color:#ddd; ">{{ $campanha->descricao }}</th>
                                </tr>

                                <th>Pergunta</th>

                                <th>Tipo</th>
                                <th>Ordem</th>
                                <th>Ação</th>
                                @foreach($perguntas as $perg)
                                <tr data-id="{{ $perg->id ?? '' }}" class="pergunta" title="Arraste para ordenar">
                                    <td>
                                        {!! $perg->texto ?? '' !!}
                                    </td>
                                    <td>
                                        {{ $perg->tipo->tipo ?? '' }}
                                    </td>
                                    <td class="position">
                                        <a>{{ $perg->ordem ?? '' }}</a>
                                    </td>
                                    <td>@if ($perg->resposta->first())
                                        <a href="{{url('/relatorios/'.$perg->id.'/detalhe')}}" class="btn btn-xs btn-info" title="Ver Respostas">
                                            Ver
                                        </a>
                                        @endif
                                        <button type="button" class="btn btn-info" onclick="window.location='{{url('/perguntas/'.$perg->id.'/edit')}}'">
                                            <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                        </button>

                                        <form action="" method="POST" onsubmit="return confirm('{{ trans('Confirma Exclusão?') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="pergunta_id" value="{{ $perg->id ?? '' }}">
                                            <input type="hidden" name="campanha_id" value="{{ $perg->campanha->id ?? '' }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger" value="X" title="Excluir">
                                                <img src="{{ asset('img/007-excluir.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                        </table>

                        <button class="btn btn-success mt-4" onclick="window.location='{{url('/perguntas/'.$campanha->id.'/create')}}'">
                            <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Inlcuir Pergunta">
                            Incluir </button>

                        <button type="button" class="btn btn-warning mt-4" onclick="window.history.back()">
                            <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
                            Voltar </button>

                        @if($campanha->temPerguntas)

                        <button type="button" class="btn btn-info mt-4" onclick="window.location = '{{url('/importar/'.$campanha->id )}}'">
                            <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Incluir Respondentes">
                            Participantes</button>
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