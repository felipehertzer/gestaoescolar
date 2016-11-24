@extends('layouts.app')

@section('content')
<div class="container">

    <h1>pessoa {{ $pessoa->id }}
        <a href="{{ url('admin/pessoas/' . $pessoa->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar pessoa"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/pessoas', $pessoa->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Apagar pessoa',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $pessoa->id }}</td>
                </tr>
                <tr><th> Nome </th><td> {{ $pessoa->nome }} </td></tr><tr><th> Cpf </th><td> {{ $pessoa->cpf }} </td></tr><tr><th> Password </th><td> {{ $pessoa->password }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
