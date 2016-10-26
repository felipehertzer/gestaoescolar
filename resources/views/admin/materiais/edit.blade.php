@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit materiai {{ $materiai->id }}</h1>

    {!! Form::model($materiai, [
        'method' => 'PATCH',
        'url' => ['/admin/materiais', $materiai->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

            <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
                {!! Form::label('nome', 'Nome', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('id_tipomaterial') ? 'has-error' : ''}}">
                {!! Form::label('id_tipomaterial', 'Tipo do Material', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('id_tipomaterial', $tipomaterial, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
                    {!! $errors->first('id_tipomaterial', '<p class="help-block">:message</p>') !!}
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