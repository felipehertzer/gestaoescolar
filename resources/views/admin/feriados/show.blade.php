@extends('layouts.app')

@section('content')
<div class="container">

    <h1>feriado {{ $feriado->id }}
        <a href="{{ url('admin/feriados/' . $feriado->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar feriado"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/feriados', $feriado->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete feriado',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $feriado->id }}</td>
                </tr>
                <tr><th> Dia </th><td> {{ $feriado->dia }} </td></tr><tr><th> Mes </th><td> {{ $feriado->mes }} </td></tr><tr><th> Ano </th><td> {{ $feriado->ano }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
