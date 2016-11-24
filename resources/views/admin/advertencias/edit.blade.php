@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Editar advertencia {{ $advertencia->id }}</h1>

    {!! Form::model($advertencia, [
        'method' => 'PATCH',
        'url' => ['/admin/advertencias', $advertencia->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}
            <div class="form-group {{ $errors->has('id_matricula') ? 'has-error' : ''}}">
                {!! Form::label('id_matricula', 'Matricula', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('id_matricula', $alunos, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
                    {!! $errors->first('id_matricula', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('motivo') ? 'has-error' : ''}}">
                {!! Form::label('motivo', 'Motivo', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('motivo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('motivo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('data') ? 'has-error' : ''}}">
                {!! Form::label('data', 'Data', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::input('date', 'data', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Atualizar', ['class' => 'btn btn-primary form-control']) !!}
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