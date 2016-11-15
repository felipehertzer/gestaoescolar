@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create New emprestamateriais</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/emprestamateriais', 'class' => 'form-horizontal', 'files' => true]) !!}
	
			<div class="form-group {{ $errors->has('dataNascimento') ? 'has-error' : ''}}">
                {!! Form::label('data', 'Data Retirada', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('data', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

		
		<div class="form-group {{ $errors->has('id_aluno') ? 'has-error' : ''}}">
            {!! Form::label('materia_turma_id', 'Disciplinas', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('materia_turma_id', $disciplinas, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
                {!! $errors->first('materia_turma_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

         <div class="form-group {{ $errors->has('id_aluno') ? 'has-error' : ''}}">
            {!! Form::label('material_id', 'Material', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('material_id', $materiais, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
                {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
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