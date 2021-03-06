@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Nova multa</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/biblioteca/multas', 'class' => 'form-horizontal', 'files' => true]) !!}

    <div class="form-group {{ $errors->has('matricula_id') ? 'has-error' : ''}}">
        {!! Form::label('matricula_id', 'Aluno', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('matricula_id', $matriculas, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
            {!! $errors->first('matricula_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('valor') ? 'has-error' : ''}}">
        {!! Form::label('valor', 'Valor', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('valor', null, ['class' => 'form-control', 'step'=>'any']) !!}
            {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('tipomulta_id') ? 'has-error' : ''}}">
        {!! Form::label('id_tipomulta', 'Tipo Multa', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('tipomulta_id', $tipomultas, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
            {!! $errors->first('tipomulta_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    {!! Form::hidden('status', App\Multa::STATUS_NAO_PAGO, ['class' => 'form-control']) !!}


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