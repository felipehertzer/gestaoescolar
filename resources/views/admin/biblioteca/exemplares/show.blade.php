@extends('layouts.app')

@section('content')
<div class="container">

    <h1>exemplare {{ $exemplare->id }}
        <a href="{{ url('admin/biblioteca/exemplares/' . $exemplare->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar exemplare"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/biblioteca/exemplares', $exemplare->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Apagar exemplare',
                    'onclick'=>'return confirm("Deseja apagar?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $exemplare->id }}</td>
                </tr>
                <tr>
                    <th> Estante </th>
                    <td> {{ $exemplare->estante }} </td>
                </tr>
                <tr>
                    <th> Prateleira </th>
                    <td> {{ $exemplare->prateleira }} </td>
                </tr>                
                <tr>
                    <th> Status </th>
                    <td> {{ App\Exemplar::getNomeStatus($exemplare->status) }} </td>
                </tr>
                <tr>
                    <th> Danificado? </th>
                    <td> {{ $exemplare->danificado ? 'Sim' : 'Não' }} </td>
                </tr>
                <tr>
                    <th> Livro </th>
                    <td> {{ $exemplare->livro->nome }} </td>
                </tr>
                <tr>
                    <th> Tipo Exemplar </th>
                    <td> {{ $exemplare->tipoexemplar->nome }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
