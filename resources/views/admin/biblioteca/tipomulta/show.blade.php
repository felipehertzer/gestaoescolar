@extends('layouts.app')

@section('content')
<div class="container">

    <h1>tipomultum {{ $tipomultum->id }}
        <a href="{{ url('admin/biblioteca/tipomulta/' . $tipomultum->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit tipomultum"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/biblioteca/tipomulta', $tipomultum->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete tipomultum',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $tipomultum->id }}</td>
                </tr>
                <tr><th> Nome </th><td> {{ $tipomultum->nome }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
