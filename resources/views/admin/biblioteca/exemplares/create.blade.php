@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Nova exemplare</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/biblioteca/exemplares', 'class' => 'form-horizontal', 'files' => true]) !!}

                    <div class="form-group {{ $errors->has('estante') ? 'has-error' : ''}}">
                {!! Form::label('estante', 'Estante', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('estante', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('estante', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('prateleira') ? 'has-error' : ''}}">
                {!! Form::label('prateleira', 'Prateleira', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('prateleira', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('prateleira', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                {!! Form::label('status', 'Status', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('status', App\Exemplar::getStatus(), null, ['class' => 'form-control']) !!}
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('danificado') ? 'has-error' : ''}}">
                {!! Form::label('danificado', 'Danificado?', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::checkbox('danificado', '1') !!}
                    {!! $errors->first('danificado', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('livro_id') ? 'has-error' : ''}}">
                {!! Form::label('livro_id', 'Livro', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('livro_id', $livros, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
                    {!! $errors->first('livro_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('tipoexemplar_id') ? 'has-error' : ''}}">
                {!! Form::label('tipoexemplar_id', 'Tipo de Exemplar', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('tipoexemplar_id', $tipoexemplares, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('tipoexemplar_id', '<p class="help-block">:message</p>') !!}
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