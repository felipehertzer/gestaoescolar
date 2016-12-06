@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Relatório de Alunos com mais faltas</h3>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Aluno</th>
                <th>Falta</th>
            </tr>
            </thead>
            <tbody>
            @foreach($presencas as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->faltas }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection