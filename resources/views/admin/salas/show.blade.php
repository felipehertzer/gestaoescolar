@extends('layouts.app')

@section('content')
<div class="container">

    <h1>sala {{ $sala->id }}
        <a href="{{ url('admin/salas/' . $sala->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar sala"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/salas', $sala->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Apagar sala',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $sala->id }}</td>
                </tr>
                <tr><th> Numero </th><td> {{ $sala->numero }} </td></tr><tr><th> Capacidade </th><td> {{ $sala->capacidade }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
