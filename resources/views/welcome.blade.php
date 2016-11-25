@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Sistema de Gerenciamento Escolar</div>

                    <div class="panel-body text-center">
                        <div class="alert alert-info text-left"> Faça o Login para continuar!</div>
                        <img src="{{asset('/images/logo.jpg') }}" class="img-responsive " style="display: inline-block;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection