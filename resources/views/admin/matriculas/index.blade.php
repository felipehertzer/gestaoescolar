@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Matriculas <a href="{{ url('/admin/matriculas/create') }}" class="btn btn-primary btn-xs" title="Adicionar matricula"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> Aluno </th>
                    <th> Turma </th>
                    <th> Observacoes </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($matriculas as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->numero_turma }}</td>
                    <td>{{ $item->observacoes }}</td>
                    <td>
                        <a href="{{ url('/admin/matriculas/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver matricula"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/matriculas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar matricula"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/matriculas', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar matricula" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar matricula',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $matriculas->render() !!} </div>
    </div>

</div>
@endsection
