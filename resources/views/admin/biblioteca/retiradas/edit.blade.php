@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit retirada {{ $retirada->id }}</h1>

    {!! Form::model($retirada, [
        'method' => 'PATCH',
        'url' => ['/admin/biblioteca/retiradas', $retirada->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

                    <div class="form-group {{ $errors->has('data_retirada') ? 'has-error' : ''}}">
                {!! Form::label('data_retirada', 'Data Retirada', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('data_retirada', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('data_retirada', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('data_devolucao') ? 'has-error' : ''}}">
                {!! Form::label('data_devolucao', 'Data Devolucao', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('data_devolucao', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('data_devolucao', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('renovacao') ? 'has-error' : ''}}">
                {!! Form::label('renovacao', 'Renovacao', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('renovacao', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('renovacao', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                {!! Form::label('status', 'Status', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('status', App\Retirada::getStatus(), null, ['class' => 'form-control']) !!}
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
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