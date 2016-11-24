@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Retiradas <a href="{{ url('/admin/biblioteca/retiradas/create') }}" class="btn btn-primary btn-xs" title="Adicionar retirada"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> Data Devolucao </th>
                    <th> Aluno </th>
                    <th> Status </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($retiradas as $item)
            {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->data_devolucao->format('d/m/Y') }}</td>
                    <td>{{ $item->matricula->aluno->pessoa->nome }}</td>
                    <td>{{ App\Retirada::getNomeStatus($item->status) }}</td>
                    <td>
                        <a href="{{ url('/admin/biblioteca/retiradas/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver retirada"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/retiradas/' . $item->id . '/devolve_tudo') }}" class="btn btn-primary btn-xs" title="Devolver Tudo"><span class="glyphicon glyphicon-check" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/retiradas/' . $item->id . '/devolve_exemplares') }}" class="btn btn-primary btn-xs" title="Devolver por Exemplares"><span class="glyphicon glyphicon-book" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/retiradas/' . $item->id . '/renovar') }}" class="btn btn-primary btn-xs" title="Renovar"><span class="glyphicon glyphicon-repeat" aria-hidden="true"/></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $retiradas->render() !!} </div>
    </div>

</div>
@endsection
