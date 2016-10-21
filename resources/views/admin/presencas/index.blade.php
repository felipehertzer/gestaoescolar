@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Presenças</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> Materia </th>
                    <th> Turma </th>
                    <th> Ano </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($presencas as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->materia_has_professor->materia->nome }}</td>
                    <td>{{ $item->turma->numero_turma }}</td>
                    <td>{{ $item->turma->ano }}</td>
                    <td>
                        <a href="{{ url('/admin/presencas/' . $item->id ) }}" class="btn btn-primary btn-xs" title="Fazer presenca"><span class="fa fa-bullhorn" aria-hidden="true"/></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $presencas->render() !!} </div>
    </div>

</div>
@endsection
