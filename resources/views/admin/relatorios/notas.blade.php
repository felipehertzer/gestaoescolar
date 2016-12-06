@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Relatório de Avaliações e sua nota média</h3>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Avaliação</th>
                <th>Turma</th>
                <th>Matéria</th>
                <th>Alunos</th>
                <th>Média</th>
            </tr>
            </thead>
            <tbody>
            @foreach($avaliacoes as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->nome }}</td>
                <td>{{ $item->numero_turma }}</td>
                <td>{{ $item->materia }}</td>
                <td>{{ $item->alunos }}</td>
                <td class="text-center {{ (($item->media / $item->alunos) >= 7 ? "success" : "danger") }}"><b>{{ number_format($item->media / $item->alunos, 2) }}</b></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection