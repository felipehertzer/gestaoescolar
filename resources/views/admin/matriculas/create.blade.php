@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Nova matricula</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/matriculas', 'class' => 'form-horizontal', 'files' => true]) !!}
        <div class="form-group {{ $errors->has('id_aluno') ? 'has-error' : ''}}">
            {!! Form::label('id_aluno', 'Aluno', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('id_aluno', $alunos, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
                {!! $errors->first('id_aluno', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('id_turma') ? 'has-error' : ''}}">
            {!! Form::label('id_turma', 'Turma', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('id_turma', $turmas, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
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
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary form-control']) !!}
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