@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create New sala</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/salas', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('numero') ? 'has-error' : ''}}">
                {!! Form::label('numero', 'Numero', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('numero', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('capacidade') ? 'has-error' : ''}}">
                {!! Form::label('capacidade', 'Capacidade', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('capacidade', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('capacidade', '<p class="help-block">:message</p>') !!}
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