@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Feriados <a href="{{ url('/admin/feriados/create') }}" class="btn btn-primary btn-xs" title="Adicionar feriado"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Dia </th><th> Mes </th><th> Ano </th><th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($feriados as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->dia }}</td><td>{{ $item->mes }}</td><td>{{ $item->ano }}</td>
                    <td>
                        <a href="{{ url('/admin/feriados/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver feriado"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/feriados/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar feriado"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/feriados', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar feriado" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar feriado',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $feriados->render() !!} </div>
    </div>

</div>
@endsection
