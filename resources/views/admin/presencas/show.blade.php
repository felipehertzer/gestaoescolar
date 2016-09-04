@extends('layouts.app')

@section('content')
<div class="container">

    <h1>presenca {{ $presenca->id }}
        <a href="{{ url('admin/presencas/' . $presenca->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit presenca"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/presencas', $presenca->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete presenca',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $presenca->id }}</td>
                </tr>
                <tr><th> Data </th><td> {{ $presenca->data }} </td></tr><tr><th> Presenca </th><td> {{ $presenca->presenca }} </td></tr><tr><th> Id Professor </th><td> {{ $presenca->id_professor }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
