@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Editar avaliaco {{ $avaliaco->id }}</h1>

    {!! Form::model($avaliaco, [
        'method' => 'PATCH',
        'url' => ['/admin/avaliacoes', $avaliaco->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}
    {!! Form::hidden('id_professor', Auth::user()->id) !!}

                    <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
                {!! Form::label('nome', 'Nome', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('peso') ? 'has-error' : ''}}">
                {!! Form::label('peso', 'Peso', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('peso', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('peso', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('trimestre') ? 'has-error' : ''}}">
                {!! Form::label('trimestre', 'Trimestre', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('trimestre', array(1 => '1º Trimestre', 2 => '2º Trimestre', 3 => '3º Trimestre'),null, ['class' => 'form-control']) !!}
                    {!! $errors->first('trimestre', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('tipo') ? 'has-error' : ''}}">
                {!! Form::label('tipo', 'Tipo', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('tipo', array('normal' => 'normal', 'exame' => 'exame'),null, ['class' => 'form-control']) !!}
                    {!! $errors->first('tipo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_materia') ? 'has-error' : ''}}">
                {!! Form::label('id_materia', 'Materia', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('id_materia', $materias, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
                    {!! $errors->first('id_materia', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_turma') ? 'has-error' : ''}}">
                {!! Form::label('id_turma', 'Turma', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('id_turma', !empty($materias) ? $turmas : array('' => 'Escolha uma matéria'), null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
                    {!! $errors->first('id_turma', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('observacoes') ? 'has-error' : ''}}">
                {!! Form::label('observacoes', 'Observacoes', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('observacoes', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('observacoes', '<p class="help-block">:message</p>') !!}
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