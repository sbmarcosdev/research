@include("template.resp_head")
@yield('content')
@include("template.resp_footer")


<div style='position:relative; top:0px; left:0px;'>
    @if(Session::get('banner_empresa'))
    <img src="{{asset(Session::get('banner_empresa'))}}" width="100%" height="100px">
    <div style='position:absolute; top:0px; left:0px;'>
        <img src="{{asset(Session::get('logo_empresa'))}}" width="70%" class="ml-4 mt-3">
    </div>
    @endif
</div>

