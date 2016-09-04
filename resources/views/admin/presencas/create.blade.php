@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create New presenca</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/presencas', 'class' => 'form-horizontal', 'files' => true]) !!}

                    <div class="form-group {{ $errors->has('data') ? 'has-error' : ''}}">
                {!! Form::label('data', 'Data', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('data', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('presenca') ? 'has-error' : ''}}">
                {!! Form::label('presenca', 'Presenca', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('presenca', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('presenca', '0', true) !!} No</label>
            </div>
                    {!! $errors->first('presenca', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_professor') ? 'has-error' : ''}}">
                {!! Form::label('id_professor', 'Id Professor', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('id_professor', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_professor', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_materia') ? 'has-error' : ''}}">
                {!! Form::label('id_materia', 'Id Materia', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('id_materia', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_materia', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_turma') ? 'has-error' : ''}}">
                {!! Form::label('id_turma', 'Id Turma', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('id_turma', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_turma', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_matricula') ? 'has-error' : ''}}">
                {!! Form::label('id_matricula', 'Id Matricula', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('id_matricula', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_matricula', '<p class="help-block">:message</p>') !!}
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