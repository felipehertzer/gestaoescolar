@extends('layouts.app')

@section('content')
<div class="container">

    <h1>series {{ $series->id }}
        <a href="{{ url('admin/series/' . $series->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar series"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/series', $series->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Apagar series',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $series->id }}</td>
                </tr>
                <tr><th> Nome </th><td> {{ $series->nome }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
