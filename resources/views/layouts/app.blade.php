<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gestão Escolar</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" integrity="" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
        {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

        <style>
            body {
                font-family: 'Lato';
            }

            .fa-btn {
                margin-right: 6px;
            }
        </style>
    </head>
    <body id="app-layout">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Gestao Escolar
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/home') }}">Inicio</a></li>
                        @if (!Auth::guest())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Matricula <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/admin/matriculas') }}"><i class="fa fa-btn fa-user"></i>Nova</a></li>
                                <li><a href="{{ url('/admin/listaespera') }}"><i class="fa fa-btn fa-list"></i>Lista de espera</a></li>
                                <li><a href="{{ url('/admin/advertencias') }}"><i class="fa fa-btn fa-user-times"></i>Advertencias</a></li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Biblioteca <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/admin/biblioteca/retirada') }}"><i class="fa fa-btn fa-reply"></i>Retirada</a></li>
                                <li><a href="{{ url('/admin/biblioteca/reserva') }}"><i class="fa fa-btn fa-clock-o"></i>Reserva</a></li>
                                <li><a href="{{ url('/admin/biblioteca/autores') }}"><i class="fa fa-btn fa-user"></i>Autor</a></li>
                                <li><a href="{{ url('/admin/biblioteca/livros') }}"><i class="fa fa-btn fa-book"></i>Livros</a></li>
                                <li><a href="{{ url('/admin/biblioteca/multas') }}"><i class="fa fa-btn fa-calendar-times-o"></i>Multas</a></li>
                                <li><a href="{{ url('/admin/biblioteca/tipomulta') }}"><i class="fa fa-btn fa-calendar-times-o"></i>Tipo de Multas</a></li>
                                <li><a href="{{ url('/admin/biblioteca/tipoexemplares') }}"><i class="fa fa-btn fa-building"></i>Tipo de Exemplar</a></li>
                                <li><a href="{{ url('/admin/biblioteca/exemplares') }}"><i class="fa fa-btn fa-building"></i>Exemplares</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Cadastros <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/admin/pessoas') }}"><i class="fa fa-btn fa-user"></i>Pessoas</a></li>
                                <li><a href="{{ url('/admin/materias') }}"><i class="fa fa-btn fa-folder"></i>Materias</a></li>
                                <li><a href="{{ url('/admin/turmas') }}"><i class="fa fa-btn fa-users"></i>Turmas</a></li>
                                <li><a href="{{ url('/admin/salas') }}"><i class="fa fa-btn fa-building"></i>Salas</a></li>
                                <li><a href="{{ url('/admin/material') }}"><i class="fa fa-btn fa-archive"></i>Material</a></li>
                                <li><a href="{{ url('/admin/series') }}"><i class="fa fa-btn fa-star"></i>Série</a></li>
                                <li><a href="{{ url('/admin/funcoes') }}"><i class="fa fa-btn fa-cogs"></i>Funções</a></li>
                                <li><a href="{{ url('/admin/tipomateriais') }}"><i class="fa fa-btn fa-archive"></i>Tipo de Material</a></li>
                                <li><a href="{{ url('/admin/feriados') }}"><i class="fa fa-btn fa-sun-o"></i>Feriados</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Avaliações <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/admin/avaliacoes') }}"><i class="fa fa-btn fa-graduation-cap"></i>Avaliações</a></li>
                                <li><a href="{{ url('/admin/notas') }}"><i class="fa fa-btn fa-sort-numeric-desc"></i>Notas</a></li>
                                <li><a href="{{ url('/admin/presencas') }}"><i class="fa fa-btn fa-calendar-check-o"></i>Presenças</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Registrar-se</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->nome }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has($msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div>
        
        @yield('content')

        <!-- JavaScripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
