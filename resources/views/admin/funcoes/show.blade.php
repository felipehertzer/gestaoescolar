@extends('layouts.app')

@section('content')
<div class="container">

    <h1>funco {{ $funco->id }}
        <a href="{{ url('admin/funcoes/' . $funco->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar funco"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/funcoes', $funco->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Apagar funco',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $funco->id }}</td>
                </tr>
                <tr><th> Nome </th><td> {{ $funco->nome }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
