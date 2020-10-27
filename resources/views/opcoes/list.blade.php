@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 490px">
                        <h4 class="tituloPrincipal">Opções Respostas</h4>
                        <table id="table" name="table" class="table table-striped table-bordered">
                            <tbody data-id="{{ $pergunta->id ?? '' }}" class="sortable">
                                <tr>
                                    <th colspan="8" style="background-color:#ddd; ">{!! $pergunta->texto !!}</th>
                                </tr>

                                <th>Opções Respostas</th>
                                <th>Tipo</th>
                                <th>Peso</th>
                                <th>Ordem</th>
                                <th>Ação</th>

                                @foreach($opcoes as $opcao)
                                <tr data-id="{{ $perg->id ?? '' }}" class="pergunta" >
                                    <td>
                                        {!! $opcao->opcaoResposta->titulo ?? '' !!}
                                    </td>
                                    <td>
                                        {!! $opcao->opcaoResposta->tipo->tipo ?? '' !!}
                                    </td>
                                    <td>
                                        {{ $opcao->opcaoResposta->peso ?? '' }}
                                    </td>
                                    <td class="position">
                                        <a>{{ $opcao->opcaoResposta->ordem ?? '' }}</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" onclick="window.location='{{url('/opcoes/'.$opcao->id.'/edit')}}'">
                                            <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                        </button>

                                        <form action="{{url('/opcoes/'.$opcao->id)}}" method="POST" onsubmit="return confirm('{{ trans('Confirma Exclusão?') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="pergunta_id" value="{{ $pergunta->id ?? '' }}">
                                            <input type="hidden" name="opcao_pergunta_id" value="{{ $opcao->id ?? '' }}">
                                            <input type="hidden" name="opcao_resposta_id" value="{{ $opcao->opcaoResposta->id ?? '' }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger" value="X" title="Excluir">
                                                <img src="{{ asset('img/007-excluir.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                        </table>

                        <button class="btn btn-success mt-4" onclick="window.location='{{url('/inserir-opcoes/'. $pergunta->id.'/create')}}'">
                            <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Inlcuir Resposta">
                            Incluir </button>

                        <button type="button" class="btn btn-secondary mt-4" onclick="window.location='{{url('/perguntas/'. $pergunta->campanha->id )}}'">
                            <img src="{{ asset('img/009-voltar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
                            Voltar </button>
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