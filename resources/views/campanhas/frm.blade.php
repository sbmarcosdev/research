@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
            
                            <h4 class="tituloPrincipal">Campanha</h4>
            
                        <body onload="jsOption('{{$campanha->empresa_id}}')">
                            <form action="{{url('/campanhas/'.$campanha->id)}}" method="POST">
                                @csrf
                                @method('patch')

                                <input type="hidden" name="campo_id" id="campo_id" value="{{ $campanha->id }}">

                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" name="descricao" class="form-control" id="descricao" value="{{ $campanha->descricao }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nome">Empresa</label>
                                    <select class="form-control" name="empresa_id" required>
                                        @foreach($empresas as $empresa)
                                        <option id="op{{$empresa->id}}" value="{{$empresa->id}}">{{ $empresa->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col-sm">
                                        <label>Data de Início</label>
                                        <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{ $campanha->data_inicio }}" required>
                                    </div>

                                    <div class="col-sm">
                                        <label>Data de Término</label>
                                        <input type="date" name="data_termino" id="data_termino" class="form-control" value="{{ $campanha->data_termino }}" required>
                                    </div>

                                    <div class="col-sm">
                                        <label>Status</label>
                                        <select class="form-control" name="status" id="status" value="{{ $campanha->status }}" required>

                                            @if($campanha->status == '1')
                                            <option selected value="1">Ativa</option>
                                            <option value="0">Inativa</option>
                                            @else
                                            <option value="1">Ativa</option>
                                            <option selected value="0">Inativa</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>


                                <button class="btn btn-success" onclick="alertaSalvar()">
                                    <img src="{{ asset('img/mais.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Página Anterior">
                                    Salvar
                                </button>
                                <button type="button" class="btn btn-warning" onclick="window.location = '{{url('campanhas')}}' ">
                                    <img src="{{ asset('img/001-editar.svg') }}" width="15" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                                    Voltar </button>

                                <hr>
                                <input type="button" class="btn btn-outline-success mb-4" value="Mensagens" onclick="window.location='{{url('/mensagens/'.$campanha->id )}}'">
                                @if($campanha->status == '1')
                                <input type="button" class="btn btn-outline-success mb-4" value="Perguntas" onclick="window.location = '{{url('/perguntas/'. $campanha->id) }}'">
                                @endif

                                @if($campanha->perguntas->first())
                                <input type="button" class="btn btn-outline-success mb-4" value="Participantes" onclick="window.location = '{{url('/importar/'. $campanha->id) }}'">
                                @endif

                                @if($campanha->respostas->first())
                                <input type="button" class="btn btn-outline-success mb-4" value="Relatórios" onclick="window.location = '{{url('/relatorios/'. $campanha->id) }}'">
                                @endif

                            </form>
                        </body>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection