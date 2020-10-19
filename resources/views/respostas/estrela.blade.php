@extends('template.resp_template')
@section('content')

<style>
    .star {
        width: 40px;
        height: 60px;
        position: relative;
        display: inline-block;
        margin: 5px;
    }

    .star .img-top {
        display: inline;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 99;
    }

    .img-botton {
        width: 100%;
        height: 70%;
    }

    .img-top {
        width: 100%;
        height: 70%;
    }
</style>
</head>

< <div class="container">
    <div class="container espacamento">
        <h4 class="tituloPrincipal">{{ $resp->campanha->descricao }}</h4>
        <h5 class="titulosub"> {{ $resp->respondente->nome }}</h5>

        <form action="{{url('/resposta')}}" method="POST" autocomplete="off">
            @csrf
            @method('patch')

            <input type="hidden" name="pergunta_id" value="{{$pergunta->id}}">
            <input type="hidden" name="tipo_id" value="7">
            <input type="hidden" name="peso_resposta" id="peso_resposta">
            <input type="hidden" name="opcao_resposta_id" id="opcao_resposta_id">

            <h5 class="mt-3"> {!! $pergunta->texto !!}</h5>

            <a class="mt-3"> {{ $pergunta->texto_ajuda }} </a>

            <div class="ceu m-3">

                <div class="star" id="div1">
                    <img src="{{asset('img/star_on_1.png')}}" class="img-botton" alt="star Back" id="1on">
                    <img src="{{asset('img/star_off_1.png')}}" class="img-top" alt="star Front" id="1off">
                </div>

                <div class="star" id="div2">
                    <img src="{{asset('img/star_on_1.png')}}" class="img-botton" alt="star Back" id="2on">
                    <img src="{{asset('img/star_off_1.png')}}" class="img-top" alt="star Front" id="2off">
                </div>

                <div class="star" id="div3">
                    <img src="{{asset('img/star_on_1.png')}}" class="img-botton" alt="star Back" id="3on">
                    <img src="{{asset('img/star_off_1.png')}}" class="img-top" alt="star Front" id="3off">
                </div>

                <div class="star" id="div4">
                    <img src="{{asset('img/star_on_1.png')}}" class="img-botton" alt="star Back" id="4on">
                    <img src="{{asset('img/star_off_1.png')}}" class="img-top" alt="star Front" id="4off">
                </div>

                <div class="star" id="div5">
                    <img src="{{asset('img/star_on_1.png')}}" class="img-botton" alt="star Back" id="5on">
                    <img src="{{asset('img/star_off_1.png')}}" class="img-top" alt="star Front" id="5off">
                </div>
            </div>
            
            <div class="mt-3">
                <label>Comentários</label>
                <input type="text" name="texto_resposta" class="form-control" id="texto_resposta">
            </div>

            <div class="tituloPrincipal mt-4">
                <button type="submit" class="btn btn-outline-info mb-4">Enviar Respostas</button>
            </div>

            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{$progresso}}%;" aria-valuenow="{{$progresso}}" aria-valuemin="0" aria-valuemax="100">{{$qtd}}</div>
            </div>

    </div>
    </div>

    <script>
        var fill = 0;
        $("#peso_resposta").val(fill);

        $("#div1").mouseover(function() {
            fill = 1;
            $("#1off").css('display', 'none');
            $("#peso_resposta").val(fill);
        });

        $("#div2").mouseover(function() {
            fill = 2;
            $("#1off").css('display', 'none');
            $("#2off").css('display', 'none');
            $("#peso_resposta").val(fill);
        });
        $("#div3").mouseover(function() {
            fill = 3;
            $("#1off").css('display', 'none');
            $("#2off").css('display', 'none');
            $("#3off").css('display', 'none');
            $("#peso_resposta").val(fill);
        });
        $("#div4").mouseover(function() {
            fill = 4;
            $("#1off").css('display', 'none');
            $("#2off").css('display', 'none');
            $("#3off").css('display', 'none');
            $("#4off").css('display', 'none');
            $("#peso_resposta").val(fill);
        });
        $("#div5").mouseover(function() {
            fill = 5;
            $("#1off").css('display', 'none');
            $("#2off").css('display', 'none');
            $("#3off").css('display', 'none');
            $("#4off").css('display', 'none');
            $("#5off").css('display', 'none');
            $("#peso_resposta").val(fill);
        });

        $("#div6").mouseover(function() {
            fill = 5;
            $("#1off").css('display', 'none');
            $("#2off").css('display', 'none');
            $("#3off").css('display', 'none');
            $("#4off").css('display', 'none');
            $("#5off").css('display', 'none');
            $("#peso_resposta").val(fill);
        });
        $("#div1").mouseleave(function() {
            fill = 0;
            $("#1off").css('display', 'inline');
            $("#2off").css('display', 'inline');
            $("#3off").css('display', 'inline');
            $("#4off").css('display', 'inline');
            $("#5off").css('display', 'inline');
            $("#peso_resposta").val(fill);
        });

        $("#div1").mouseover(function() {
            fill = 1;
            $("#2off").css('display', 'inline');
            $("#3off").css('display', 'inline');
            $("#4off").css('display', 'inline');
            $("#5off").css('display', 'inline');
            $("#peso_resposta").val(fill);
        });
        $("#div2").mouseover(function() {
            fill = 2;
            $("#3off").css('display', 'inline');
            $("#4off").css('display', 'inline');
            $("#5off").css('display', 'inline');
            $("#peso_resposta").val(fill);
        });
        $("#div3").mouseover(function() {
            fill = 3;
            $("#4off").css('display', 'inline');
            $("#5off").css('display', 'inline');
            $("#peso_resposta").val(fill);
        });
        $("#div4").mouseover(function() {
            fill = 4;
            $("#5off").css('display', 'inline');
            $("#peso_resposta").val(fill);
        });
    </script>
    @endsection