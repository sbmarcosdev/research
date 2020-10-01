@extends('template.template')
@section('content')

<div class="container">
    <div class="container espacamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 480px">
                        <div class="col-sm-12">
                            
                            <h4>Classic editor</h4>
                            <div id="editor">
                                <p>This is some sample content.</p>
                                <input type="textarea">{{ $mensagem->boas_vindas }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@scripts
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endscripts