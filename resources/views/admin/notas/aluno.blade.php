@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Avaliações</h1>
        <div class="table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Avaliação</th>
                    <th>Materia</th>
                    <th> Trimestre </th>
                    <th> Tipo </th>
                    <th> Peso </th>
                    <th> Nota </th>
                </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($avaliacoes as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->materia }}</td>
                        <td>{{ $item->trimestre }}</td>
                        <td>{{ $item->tipo }}</td>
                        <td>{{ $item->peso }}</td>
                        <td>{{ $item->nota }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $avaliacoes->render() !!} </div>
        </div>

    </div>
@endsection
