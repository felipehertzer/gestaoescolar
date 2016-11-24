@extends('layouts.app')

@section('content')
<div class="container">

    <h1>autore {{ $autores->id }}
        <a href="{{ url('admin/biblioteca/autores/' . $autores->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar autore"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/biblioteca/autores', $autores->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Apagar autore',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $autores->id }}</td>
                </tr>
                <tr><th> Nome </th><td> {{ $autores->nome }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
