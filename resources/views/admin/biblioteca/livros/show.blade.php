@extends('layouts.app')

@section('content')
<div class="container">

    <h1>livro {{ $livro->id }}
        <a href="{{ url('admin/biblioteca/livros/' . $livro->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar livro"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/biblioteca/livros', $livro->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Apagar livro',
                    'onclick'=>'return confirm("Deseja apagar?")'
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
    
    <div class="autores">
        <h2>Autores</h2>
        @foreach($livro->autores as $autor)
            <span> {{ $autor->nome }} </span> <br />
        @endforeach
    </div>

</div>
@endsection
