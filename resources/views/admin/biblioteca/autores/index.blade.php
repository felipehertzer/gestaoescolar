@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Autores <a href="{{ url('/admin/biblioteca/autores/create') }}" class="btn btn-primary btn-xs" title="Adicionar autore"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Nome </th><th>Ações</th>
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
                        <a href="{{ url('/admin/biblioteca/autores/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver autore"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/autores/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar autore"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/biblioteca/autores', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar autore" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar autore',
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
