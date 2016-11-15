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
                            <a href="{{ url('/admin/pessoas') }}" class="list-group-item"><i class="fa fa-user-o"></i> Cadastrar Pessoa</a>
                            <a href="{{ url('/admin/matriculas') }}" class="list-group-item"><i class="fa fa-user"></i> Realizar Matricula</a>
                            <a href="{{ url('/admin/biblioteca/retiradas') }}" class="list-group-item"><i class="fa fa-btn fa-reply"></i>Retirada</a>
                            <a href="{{ url('/admin/biblioteca/reservas') }}" class="list-group-item"><i class="fa fa-clock-o"></i> Reserva</a>
                            <a href="{{ url('/admin/emprestamateriais') }}" class="list-group-item"><i class="fa fa-share-square-o"></i> Emprestar Material</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
