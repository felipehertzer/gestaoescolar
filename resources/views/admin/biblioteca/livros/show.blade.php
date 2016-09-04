@extends('layouts.app')

@section('content')
<div class="container">

    <h1>livro {{ $livro->id }}
        <a href="{{ url('admin/biblioteca/livros/' . $livro->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit livro"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/biblioteca/livros', $livro->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete livro',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $livro->id }}</td>
                </tr>
                <tr><th> Nome </th><td> {{ $livro->nome }} </td></tr><tr><th> Ano </th><td> {{ $livro->ano }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
