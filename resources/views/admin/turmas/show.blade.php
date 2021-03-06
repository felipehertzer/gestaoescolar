@extends('layouts.app')

@section('content')
<div class="container">

    <h1>turma {{ $turma->id }}
        <a href="{{ url('admin/turmas/' . $turma->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar turma"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/turmas', $turma->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Apagar turma',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $turma->id }}</td>
                </tr>
                <tr><th> Turno </th><td> {{ $turma->turno }} </td></tr>
                <tr><th> Vagas </th><td> {{ $turma->vagas }} </td></tr>
                <tr><th> Numero Turma </th><td> {{ $turma->numero_turma }} </td></tr>
                <tr><th> Ano </th><td> {{ $turma->ano }} </td></tr>
                <tr><th> Sala </th><td> {{ $turma->sala->numero }} </td></tr>
                <tr><th> Série </th><td> {{ $turma->serie->nome }} </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
