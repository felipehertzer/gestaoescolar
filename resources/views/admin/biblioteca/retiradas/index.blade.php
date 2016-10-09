@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Retiradas <a href="{{ url('/admin/biblioteca/retiradas/create') }}" class="btn btn-primary btn-xs" title="Add New retirada"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Data Retirada </th><th> Data Devolucao </th><th> Renovacao </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($retiradas as $item)
            {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->data_retirada }}</td>
                    <td>{{ $item->data_devolucao }}</td>
                    <td>{{ $item->renovacao }}</td>
                    <td>
                        <a href="{{ url('/admin/biblioteca/retiradas/' . $item->id) }}" class="btn btn-success btn-xs" title="View retirada"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/retiradas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit retirada"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/biblioteca/retiradas', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete retirada" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete retirada',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $retiradas->render() !!} </div>
    </div>

</div>
@endsection
