@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Turmas <a href="{{ url('/admin/turmas/create') }}" class="btn btn-primary btn-xs" title="Adicionar turma"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> Vagas </th>
                    <th> Numero Turma </th>
                    <th> Ano </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($turmas as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->vagas }}</td>
                    <td>{{ $item->numero_turma }}</td>
                    <td>{{ $item->ano }}</td>
                    <td>
                        <a href="{{ url('/admin/turmas/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver turma"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/turmas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar turma"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/turmas', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar turma" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar turma',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $turmas->render() !!} </div>
    </div>

</div>
@endsection
