@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create New reserva</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/biblioteca/reservas', 'class' => 'form-horizontal', 'files' => true]) !!}

                    <div class="form-group {{ $errors->has('data_reserva') ? 'has-error' : ''}}">
                {!! Form::label('data_reserva', 'Data Reserva', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('data_reserva', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('data_reserva', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('data_agenda') ? 'has-error' : ''}}">
                {!! Form::label('data_agenda', 'Data Agenda', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('data_agenda', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('data_agenda', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('matricula_id') ? 'has-error' : ''}}">
                {!! Form::label('matricula_id', 'Aluno', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('matricula_id', $matriculas, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('matricula_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection