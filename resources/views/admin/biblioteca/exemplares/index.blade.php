@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Exemplares <a href="{{ url('/admin/biblioteca/exemplares/create') }}" class="btn btn-primary btn-xs" title="Adicionar exemplare"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Estante</th>
                    <th>Prateleira</th>
                    <th>Livro</th>
                    <th>Status</th>                    
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($exemplares as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->estante }}</td>
                    <td>{{ $item->prateleira }}</td>
                    <td>{{ $item->livro->nome }}</td>
                    <td>{{ App\Exemplar::getNomeStatus($item->status) }}</td>                    
                    <td>
                        <a href="{{ url('/admin/biblioteca/exemplares/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver exemplare"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/exemplares/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar exemplare"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/biblioteca/exemplares', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar exemplare" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar exemplare',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $exemplares->render() !!} </div>
    </div>

</div>
@endsection
