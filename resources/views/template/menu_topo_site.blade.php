<nav class="corEmpresa navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <img src="Logo-corEmpresa.svg" alt="">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="nav-link li_menu_topo" href="{{url('empresas')}}">
            @if(Session::get('login_admin'))
            @foreach(Session::get('login_admin') as $user)
            {{$user}}

            @endforeach
            @endif
        </a>


        @if(isset($user))
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link li_menu_topo" href="{{url('empresas')}}">
                        Empresas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link li_menu_topo" href="{{url('campanhas')}}">
                        Campanhas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link li_menu_topo" href="{{url('relatorios')}}">
                        Relatórios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link li_menu_topo" href="{{url('usuarios')}}">
                        Admin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link li_menu_topo" href="{{url('sair')}}">
                        Sair
                    </a>
                </li>
            </ul>


            @endif
        </div>
    </div>
</nav>

<div>
    @if(Session::get('status_campanha'))
    <a href="{{url(Session::get('link_status'))}}">
        <img src="{{asset(Session::get('status_campanha'))}}" class="fases" title="{{Session::get('titulo_status')}}">
    </a>
    <h5 class="fasesTitulo"> {{Session::get('titulo_fase')}} </h5>
    @else
    <a href="{{url('campanhas')}}"> <img src="{{asset('img/vazio.png')}}" class="fases" title="Página Inicial">
    </a>
    @endif

</div>
