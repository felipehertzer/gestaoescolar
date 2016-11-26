@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Lista de Espera {{ $listaespera->id }}
        <a href="{{ url('admin/listaespera/' . $listaespera->id . '/realizar_matricula') }}" class="btn btn-primary btn-xs" title="Realizar Matrícula"><span class="glyphicon glyphicon-user" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/listaespera', $listaespera->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Apagar listaespera',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $listaespera->id }}</td>
                </tr>
                <tr>
                    <th> Aluno </th><td> {{ $listaespera->aluno->pessoa->nome }} </td>
                </tr>
                <tr>
                    <th> Turma </th><td> {{ $listaespera->turma->numero_turma }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
