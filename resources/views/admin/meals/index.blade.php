@extends('layouts.admin')
@include("template.menu_topo_site")
@yield('content')
@include("template.footer")
@section('content')

<div class="container">
    <div class="container espacamento">

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="perguntas/2/create">
                    Incluir
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Pesquisa de Satisfação
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Perguntas
                                </th>
                                <th>
                                    Empresa
                                </th>
                                <th>
                                    Peso
                                </th>
                                <th>
                                    Dica
                                </th>
                                <th>
                                    Ordem
                                </th>
                                <th>
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        @foreach($categories as $category)
                        <tbody data-id="{{ $category->id }}" class="sortable">
                            <tr>
                                <td colspan="8" style="background-color:#ddd;">{{ $category->name }}</td>
                            </tr>
                            @foreach($category->meals as $meal)
                            <tr data-id="{{ $meal->id }}" class="meal">
                                <td>
                                    {{ $meal->id ?? '' }}
                                </td>
                                <td>
                                    {{ $meal->name ?? '' }}
                                </td>
                                <td class="category-name">
                                    {{ $meal->category->name ?? '' }}
                                </td>
                                <td>
                                    {{ $meal->price ?? '' }}
                                </td>
                                <td>
                                    {{ $meal->description ?? '' }}
                                </td>

                                <td class="position">
                                    {{ $meal->position ?? '' }}
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="">
                                        Editar
                                    </a>

                                    <form action="" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Excluir">
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                            <tr class="empty-message" @if($category->meals->count()) style="display:none;"@endif>
                                <td colspan="8" class="text-center">
                                    Não Perguntas para esta Campanha
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

        @endsection

        @section('scripts')
        @parent
        <script>
            function sendReorderMealsRequest($category) {
                var items = $category.sortable('toArray', {
                    attribute: 'data-id'
                });
                var ids = $.grep(items, (item) => item !== "");

                if ($category.find('tr.meal').length) {
                    $category.find('.empty-message').hide();
                }
                $category.find('.category-name').text($category.find('tr:first td').text());

                $.post("{{ route('admin.meals.reorder') }}", {
                        _token,
                        ids,
                        category_id: $category.data('id')
                    })
                    .done(function(response) {
                        $category.children('tr.meal').each(function(index, meal) {
                            $(meal).children('.position').text(response.positions[$(meal).data('id')])
                        });
                    })
                    .fail(function(response) {
                        alert('Error occured while sending reorder request');
                        location.reload();
                    });
            }

            $(document).ready(function() {
                var $categories = $('table');
                var $meals = $('.sortable');

                $categories.sortable({
                    cancel: 'thead',
                    stop: () => {
                        var items = $categories.sortable('toArray', {
                            attribute: 'data-id'
                        });
                        var ids = $.grep(items, (item) => item !== "");
                        $.post("{{ route('admin.categories.reorder') }}", {
                                _token,
                                ids
                            })
                            .fail(function(response) {
                                alert('Error occured while sending reorder request');
                                location.reload();
                            });
                    }
                });

                $meals.sortable({
                    connectWith: '.sortable',
                    items: 'tr.meal',
                    stop: (event, ui) => {
                        sendReorderMealsRequest($(ui.item).parent());

                        if ($(event.target).data('id') != $(ui.item).parent().data('id')) {
                            if ($(event.target).find('tr.meal').length) {
                                sendReorderMealsRequest($(event.target));
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
