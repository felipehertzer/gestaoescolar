@extends('layouts.app')

@section('content')
<div class="container">

    <h1>matricula {{ $matricula->id }}
        <a href="{{ url('admin/matriculas/' . $matricula->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar matricula"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/matriculas', $matricula->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Apagar matricula',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $matricula->id }}</td>
                </tr>
                <tr><th> Aluno </th><td> {{ $matricula->aluno->pessoa->nome }} </td></tr>
                <tr><th> Turma </th><td> {{ $matricula->turma->numero_turma }} </td></tr>
                <tr><th> Observacoes </th><td> {{ $matricula->observacoes }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
