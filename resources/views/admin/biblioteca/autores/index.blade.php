@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Autores <a href="{{ url('/admin/biblioteca/autores/create') }}" class="btn btn-primary btn-xs" title="Add New autore"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Nome </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($autores as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>
                        <a href="{{ url('/admin/biblioteca/autores/' . $item->id) }}" class="btn btn-success btn-xs" title="View autore"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/autores/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar autore"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/biblioteca/autores', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete autore" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete autore',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $autores->render() !!} </div>
    </div>

</div>
@endsection
