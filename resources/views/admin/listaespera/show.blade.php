@extends('layouts.app')

@section('content')
<div class="container">

    <h1>listaespera {{ $listaespera->id }}
        <a href="{{ url('admin/listaespera/' . $listaespera->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit listaespera"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/listaespera', $listaespera->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete listaespera',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $listaespera->id }}</td>
                </tr>
                <tr><th> Id Serie </th><td> {{ $listaespera->id_serie }} </td></tr><tr><th> Id Matricula </th><td> {{ $listaespera->id_matricula }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
