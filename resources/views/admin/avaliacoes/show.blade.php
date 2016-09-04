@extends('layouts.app')

@section('content')
<div class="container">

    <h1>avaliaco {{ $avaliaco->id }}
        <a href="{{ url('admin/avaliacoes/' . $avaliaco->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit avaliaco"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/avaliacoes', $avaliaco->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete avaliaco',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $avaliaco->id }}</td>
                </tr>
                <tr><th> Nome </th><td> {{ $avaliaco->nome }} </td></tr><tr><th> Peso </th><td> {{ $avaliaco->peso }} </td></tr><tr><th> Observacoes </th><td> {{ $avaliaco->observacoes }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
