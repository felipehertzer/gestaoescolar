@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Salas <a href="{{ url('/admin/salas/create') }}" class="btn btn-primary btn-xs" title="Add New sala"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Numero </th><th> Capacidade </th><th>Actions</th>
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
                        <a href="{{ url('/admin/salas/' . $item->id) }}" class="btn btn-success btn-xs" title="View sala"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/salas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit sala"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/salas', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete sala" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete sala',
                                    'onclick'=>'return confirm("Confirm delete?")'
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
