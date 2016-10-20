@extends('layouts.app')

@section('content')
<div class="container">

    <h1>nota {{ $nota->id }}
        <a href="{{ url('admin/notas/' . $nota->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit nota"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/notas', $nota->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete nota',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $nota->id }}</td>
                </tr>
                <tr><th> Nota </th><td> {{ $nota->nota }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
