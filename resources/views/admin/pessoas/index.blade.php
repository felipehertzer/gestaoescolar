@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Pessoas <a href="{{ url('/admin/pessoas/create') }}" class="btn btn-primary btn-xs" title="Adicionar pessoa"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> Nome </th>
					<th> Tipo </th>
                    <th> Telefone </th>
                    <th> Status </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($pessoas as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->nome }}</td><td>{{ $item->getNomeTipoPessoa($item->tipopessoa) }}</td><td>{{ $item->telefoneFixo }}</td><td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ url('/admin/pessoas/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver pessoa"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/pessoas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar pessoa"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/pessoas', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar pessoa" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar pessoa',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $pessoas->render() !!} </div>
    </div>

</div>
@endsection
