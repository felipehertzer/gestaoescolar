@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit feriado {{ $feriado->id }}</h1>

    {!! Form::model($feriado, [
        'method' => 'PATCH',
        'url' => ['/admin/feriados', $feriado->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('dia') ? 'has-error' : ''}}">
                {!! Form::label('dia', 'Dia', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('dia', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('dia', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('mes') ? 'has-error' : ''}}">
                {!! Form::label('mes', 'Mes', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('mes', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('mes', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('ano') ? 'has-error' : ''}}">
                {!! Form::label('ano', 'Ano', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('ano', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('ano', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('tipo') ? 'has-error' : ''}}">
                {!! Form::label('tipo', 'Tipo', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('tipo', get_enum_values('feriado', 'tipo'), null, ['class' => 'form-control']) !!}
                    {!! $errors->first('tipo', '<p class="help-block">:message</p>') !!}
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