@extends('layouts.app')

@section('content')
<div class="container">

    <h1>matricula {{ $matricula->id }}
        <a href="{{ url('admin/matriculas/' . $matricula->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit matricula"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/matriculas', $matricula->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete matricula',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $matricula->id }}</td>
                </tr>
                <tr><th> Observacoes </th><td> {{ $matricula->observacoes }} </td></tr><tr><th> Id Aluno </th><td> {{ $matricula->id_aluno }} </td></tr><tr><th> Id Turma </th><td> {{ $matricula->id_turma }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
