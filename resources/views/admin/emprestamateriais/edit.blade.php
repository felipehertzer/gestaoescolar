@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Editar admin/emprestamateriais {{ $emprestamateriais->id }}</h1>

    {!! Form::model($materiasemprestado, [
        'method' => 'PATCH',
        'url' => ['/admin/emprestamateriais', admin/emprestamateriais->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

        

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