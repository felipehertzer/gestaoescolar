@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Salas <a href="{{ url('/admin/salas/create') }}" class="btn btn-primary btn-xs" title="Adicionar sala"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Numero </th><th> Capacidade </th><th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($salas as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->numero }}</td><td>{{ $item->capacidade }}</td>
                    <td>
                        <a href="{{ url('/admin/salas/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver sala"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/salas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar sala"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/salas', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar sala" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar sala',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $salas->render() !!} </div>
    </div>

</div>
@endsection
