@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Editar materia {{ $materia->id }}</h1>

    {!! Form::model($materia, [
        'method' => 'PATCH',
        'url' => ['/admin/materias', $materia->id],
        'class' => 'form-horizontal'
    ]) !!}

            <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
                {!! Form::label('nome', 'Nome', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('id_professor', 'Professor', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-xs-5">
                            {!! Form::select('professores[]', $professores, null, ['class' => 'form-control', 'size' => '8', 'multiple' => 'multiple', 'id' => 'multiselect']) !!}
                        </div>
                        <div class="col-xs-2">
                            <button type="button" id="multiselect_rightAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                            <button type="button" id="multiselect_rightSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                            <button type="button" id="multiselect_leftSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                            <button type="button" id="multiselect_leftAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                        </div>
                        <div class="col-xs-5">
                            {!! Form::select('professores_escolhidos[]', $professores_escolhidos, null, ['class' => 'form-control', 'size' => '8', 'multiple' => 'multiple', 'id' => 'multiselect_to']) !!}
                        </div>
                    </div>
                </div>
            </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Atualizar', ['class' => 'btn btn-primary form-control']) !!}
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