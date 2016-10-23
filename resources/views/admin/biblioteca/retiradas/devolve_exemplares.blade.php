@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Devolver Exemplares da retirada {{ $retirada->id }}</h1>

    {!! Form::open([
    'method' => 'POST',
    'url' => '/admin/biblioteca/retiradas/' . $retirada->id . '/devolve_exemplares',
    'class' => 'form-horizontal'
    ]) !!}

    <div class="form-group">
        {!! Form::label('data_devolucao', 'Aluno', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <span class="form-control">{!! $retirada->matricula->aluno->pessoa->nome !!}</span>
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('data_retirada', 'Data Retirada', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <span class="form-control">{!! $retirada->data_retirada->format('d/m/Y') !!}</span>
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('data_devolucao', 'Data Devolucao', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <span class="form-control">{!! $retirada->data_devolucao->format('d/m/Y') !!}</span>
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('exemplares', 'Retirados', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <div class="row">
                <div class="col-xs-5">
                    {!! Form::select('exemplares_retirados[]', $exemplaresRetirados, null, ['class' => 'form-control', 'size' => '8', 'multiple' => 'multiple', 'id' => 'multiselect']) !!}
                </div>
                <div class="col-xs-2">
                    <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                    <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>                    
                </div>
                <div class="col-xs-5">
                    {!! Form::select('exemplares_devolvidos[]', $exemplaresDevolvidos, null, ['class' => 'form-control', 'size' => '8', 'multiple' => 'multiple', 'id' => 'multiselect_to']) !!}
                </div>
            </div>
        </div>
    </div>                


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Devolver', ['class' => 'btn btn-primary form-control']) !!}
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