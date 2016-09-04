@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Listaespera <a href="{{ url('/admin/listaespera/create') }}" class="btn btn-primary btn-xs" title="Add New listaespera"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Id Serie </th><th> Id Matricula </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($listaespera as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id_serie }}</td><td>{{ $item->id_matricula }}</td>
                    <td>
                        <a href="{{ url('/admin/listaespera/' . $item->id) }}" class="btn btn-success btn-xs" title="View listaespera"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/listaespera/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit listaespera"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/listaespera', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete listaespera" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete listaespera',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $listaespera->render() !!} </div>
    </div>

</div>
@endsection
