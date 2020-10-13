@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <h4 class="tituloPrincipal">Participantes</h4>

                            <div class="form group mt-3">

                                <button type="button" class="btn btn-info" onclick="window.location='{{ url('/importar/' .$campanha->id. '/edit/' )}}' ">
                                    <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
                                    Importar </button>

                                <button type="button" class="btn btn-warning" onclick="window.location='{{ url('/campanhas/' .$campanha->id. '/edit/' )}}' ">
                                    <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
                                    Voltar </button>

                            </div>

                            <table id="table" name="table" class="table table-striped table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-Mail</th>
                                        <th>Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pesq as $resp)
                                    <tr>
                                        <td>{{ $resp->respondente->nome }}</td>
                                        <td>{{ $resp->respondente->email }}</td>
                                        <td>{{ $campanha->empresa->link_acesso}}/responder/{{$campanha->id }}/{{ $resp->respondente->id}}</td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            dom: 'Bfrtip',
            buttons: ['csvHtml5'],
            responsive: true,
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                "select": {
                    "rows": {
                        "_": "Selecionado %d linhas",
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha"
                    }
                }
            }
        })
    })
</script>
@endsection