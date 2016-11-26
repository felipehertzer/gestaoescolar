@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Lista de Espera</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> Aluno </th>
                    <th> Série </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($listaespera as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->aluno->pessoa->nome }}</td>
                    <td>{{ $item->serie->nome }}</td>
                    <td>
                        <a href="{{ url('/admin/listaespera/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver listaespera"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/listaespera/' . $item->id . '/realizar_matricula') }}" class="btn btn-primary btn-xs" title="Realizar Matrícula"><span class="glyphicon glyphicon-user" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/listaespera', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar listaespera" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar listaespera',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $listaespera->render() !!} </div>
    </div>

</div>
@endsection
