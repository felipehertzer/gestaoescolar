@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h3 style="margin-top:0px;">Seja bem-vindo ao sistema de gerenciamento escolar</h3>

                        <div class="list-group">
                            @if(App\Lib\Permissoes::podeExibirMenu('pessoas'))
                                <a href="{{ url('/admin/pessoas') }}" class="list-group-item"><i class="fa fa-user-o"></i> Cadastrar Pessoa</a>
                            @endif
                            
                            @if(App\Lib\Permissoes::podeExibirMenu('matriculas'))
                                <a href="{{ url('/admin/matriculas') }}" class="list-group-item"><i class="fa fa-user"></i> Realizar Matricula</a>
                            @endif
                            
                            @if(App\Lib\Permissoes::podeExibirMenu('retiradas'))
                                <a href="{{ url('/admin/biblioteca/retiradas') }}" class="list-group-item"><i class="fa fa-btn fa-reply"></i>Retirada</a>
                            @endif
                            
                            @if(App\Lib\Permissoes::podeExibirMenu('reservas'))
                                <a href="{{ url('/admin/biblioteca/reservas') }}" class="list-group-item"><i class="fa fa-clock-o"></i> Reserva</a>
                            @endif
                            
                            @if(App\Lib\Permissoes::podeExibirMenu('emprestamateriais'))
                                <a href="{{ url('/admin/emprestamateriais') }}" class="list-group-item"><i class="fa fa-share-square-o"></i> Emprestar Material</a>
                            @endif

                            @if(App\Lib\Permissoes::podeExibirMenu('avaliacoes'))
                                <a href="{{ url('/admin/avaliacoes') }}" class="list-group-item"><i class="fa fa-btn fa-graduation-cap"></i> Avaliações</a>
                            @endif

                            @if(App\Lib\Permissoes::podeExibirMenu('notas'))
                                <a href="{{ url('/admin/notas') }}" class="list-group-item"><i class="fa fa-btn fa-sort-numeric-desc"></i> Notas</a>
                            @endif

                            @if(App\Lib\Permissoes::podeExibirMenu('presencas'))
                                <a href="{{ url('/admin/presencas') }}" class="list-group-item"><i class="fa fa-btn fa-calendar-check-o"></i> Presenças</a>
                            @endif

                            @if(App\Lib\Permissoes::podeExibirMenu('lista_notas'))
                                <a href="{{ url('/aluno/lista_notas') }}" class="list-group-item"><i class="fa fa-btn fa-sort-numeric-desc"></i> Notas</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
