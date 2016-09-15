@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Presencas</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Materia </th><th> Turma </th><th> Id Professor </th><th>Actions</th>
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
                    <td>{{ $item->id_professor }}</td>
                    <td>
                        <a href="{{ url('/admin/presencas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Fazer presenca"><span class="fa fa-bullhorn" aria-hidden="true"/></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $presencas->render() !!} </div>
    </div>

</div>
@endsection
