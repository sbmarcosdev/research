@extends('template.template')
@section('content')
<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">
                            <div class="col-lg-12" style="text-align: right;">
                                <button type="button" class="btn-info" onClick='window.history.back()'>Voltar</button>
                            </div>
                          
            
                            <table class="table table-striped" style="width: 100%; margin: 0 auto;">
                                <thead>
                                    <tr>
                                        <th> {!! $pergunta->texto !!} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($respostas as $resposta)
                                    <tr>
                                        <td>{{ $resposta->texto_resposta }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection