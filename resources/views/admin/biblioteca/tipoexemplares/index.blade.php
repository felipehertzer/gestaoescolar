@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Tipoexemplares <a href="{{ url('/admin/biblioteca/tipoexemplares/create') }}" class="btn btn-primary btn-xs" title="Adicionar tipoexemplare"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Nome </th><th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($tipoexemplares as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>
                        <a href="{{ url('/admin/biblioteca/tipoexemplares/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver tipoexemplare"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/tipoexemplares/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar tipoexemplare"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/biblioteca/tipoexemplares', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar tipoexemplare" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar tipoexemplare',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $tipoexemplares->render() !!} </div>
    </div>

</div>
@endsection
