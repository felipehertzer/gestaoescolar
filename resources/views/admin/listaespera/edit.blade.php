@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit listaespera {{ $listaespera->id }}</h1>

    {!! Form::model($listaespera, [
        'method' => 'PATCH',
        'url' => ['/admin/listaespera', $listaespera->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

                    <div class="form-group {{ $errors->has('id_serie') ? 'has-error' : ''}}">
                {!! Form::label('id_serie', 'Id Serie', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('id_serie', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_serie', '<p class="help-block">:message</p>') !!}
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