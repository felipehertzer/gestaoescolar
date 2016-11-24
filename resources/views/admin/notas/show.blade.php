@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Avaliações</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> Nome </th>
                <th> Peso </th>
                <th> Trimestre </th>
                <th> Tipo </th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($avaliacoes as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->peso }}</td>
                    <td>{{ $item->trimestre }}</td>
                    <td>{{ $item->tipo }}</td>
                    <td>
                        <a href="{{ url('/admin/notas/' . $item->id. '/edit' ) }}" class="btn btn-primary btn-xs" title="Cadastrar notas"><span class="fa fa-plus" aria-hidden="true"/></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $avaliacoes->render() !!} </div>
    </div>

</div>
@endsection
