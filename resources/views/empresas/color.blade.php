@extends('template.template')
@section('content')


<div id='colorPicker' style="margin-top: 300px;">
    
    <input type='color' value='#ea0437' id="inputcolor" class='form-control' onchange="jsCor()"/>

</div>

@endsection

@section('scripts')

<script>
    function jsCor(){
        alert( $('#inputcolor').val());
    }

</script>
@endsection