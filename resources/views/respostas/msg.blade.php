@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 500px">
                        <div class="col-sm-12">

                            <body onload="alertFim()">
                                <h4> @if(isset($resp->campanha->descricao )) {{ $resp->campanha->descricao }} @endif</h4>
                                <hr>
                                <h4> {{ $msg['msg'] }}</h4>
                            </body>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection