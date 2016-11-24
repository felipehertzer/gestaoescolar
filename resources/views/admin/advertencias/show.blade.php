@extends('layouts.app')

@section('content')
<div class="container">

    <h1>advertencia {{ $advertencia->id }}
        <a href="{{ url('admin/advertencias/' . $advertencia->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar advertencia"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/advertencias', $advertencia->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete advertencia',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $advertencia->id }}</td>
                </tr>
                <tr><th> Motivo </th><td> {{ $advertencia->motivo }} </td></tr><tr><th> Data </th><td> {{ $advertencia->data }} </td></tr><tr><th> Id Matricula </th><td> {{ $advertencia->id_matricula }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
