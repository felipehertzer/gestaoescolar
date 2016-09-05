@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit turma {{ $turma->id }}</h1>

    {!! Form::model($turma, [
        'method' => 'PATCH',
        'url' => ['/admin/turmas', $turma->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}
            <div class="form-group {{ $errors->has('turno') ? 'has-error' : ''}}">
                {!! Form::label('turno', 'Turno', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('turno', ['manha', 'tarde', 'noite'] , null, ['class' => 'form-control']) !!}
                    {!! $errors->first('turno', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('vagas') ? 'has-error' : ''}}">
                {!! Form::label('vagas', 'Vagas', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('vagas', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('vagas', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('numero_turma') ? 'has-error' : ''}}">
                {!! Form::label('numero_turma', 'Numero Turma', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('numero_turma', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('numero_turma', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('ano') ? 'has-error' : ''}}">
                {!! Form::label('ano', 'Ano', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('ano', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('ano', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_sala') ? 'has-error' : ''}}">
                {!! Form::label('id_sala', 'Sala', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('id_sala', $salas, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_sala', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_serie') ? 'has-error' : ''}}">
                {!! Form::label('id_serie', 'Série', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('id_serie', $series, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_serie', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('id_materias', 'Materias', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-xs-5">
                            {!! Form::select('materias', $materias, null, ['class' => 'form-control', 'size' => '8', 'multiple' => 'multiple', 'id' => 'multiselect']) !!}
                        </div>
                        <div class="col-xs-2">
                            <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                            <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                            <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                            <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                        </div>
                        <div class="col-xs-5">
                            {!! Form::select('materias_escolhidas', [], null, ['class' => 'form-control', 'size' => '8', 'multiple' => 'multiple', 'id' => 'multiselect_to']) !!}
                        </div>
                    </div>
                </div>
            </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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