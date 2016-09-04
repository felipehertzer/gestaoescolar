@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Presencas <a href="{{ url('/admin/presencas/create') }}" class="btn btn-primary btn-xs" title="Add New presenca"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Data </th><th> Presenca </th><th> Id Professor </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($presencas as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->data }}</td><td>{{ $item->presenca }}</td><td>{{ $item->id_professor }}</td>
                    <td>
                        <a href="{{ url('/admin/presencas/' . $item->id) }}" class="btn btn-success btn-xs" title="View presenca"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/presencas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit presenca"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/presencas', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete presenca" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete presenca',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $presencas->render() !!} </div>
    </div>

</div>
@endsection
