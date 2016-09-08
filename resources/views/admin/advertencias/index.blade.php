@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Advertencias <a href="{{ url('/admin/advertencias/create') }}" class="btn btn-primary btn-xs" title="Add New advertencia"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Motivo </th><th> Data </th><th> Id Matricula </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($advertencias as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->motivo }}</td>
                    <td>{{ $item->data }}</td>
                    <td>{{ $item->id_matricula }}</td>
                    <td>
                        <a href="{{ url('/admin/advertencias/' . $item->id) }}" class="btn btn-success btn-xs" title="View advertencia"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/advertencias/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit advertencia"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/advertencias', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete advertencia" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete advertencia',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $advertencias->render() !!} </div>
    </div>

</div>
@endsection
