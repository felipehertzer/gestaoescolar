@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Materias </h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> Nota </th>
                    <th> Turma </th>
                    <th> Ano </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($notas as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->numero_turma }}</td>
                    <td>{{ $item->ano }}</td>
                    <td>
                        <a href="{{ url('/admin/notas/' . $item->id ) }}" class="btn btn-primary btn-xs" title="Cadastrar nota"><span class="fa fa-bullhorn" aria-hidden="true"/></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $notas->render() !!} </div>
    </div>

</div>
@endsection
