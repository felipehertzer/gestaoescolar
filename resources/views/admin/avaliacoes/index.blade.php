@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Avaliacoes <a href="{{ url('/admin/avaliacoes/create') }}" class="btn btn-primary btn-xs" title="Add New avaliaco"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Nome </th><th> Peso </th><th> Observacoes </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($avaliacoes as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->nome }}</td><td>{{ $item->peso }}</td><td>{{ $item->observacoes }}</td>
                    <td>
                        <a href="{{ url('/admin/avaliacoes/' . $item->id) }}" class="btn btn-success btn-xs" title="View avaliaco"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/avaliacoes/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar avaliaco"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/notas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Notas"><span class="fa fa-btn fa-sort-numeric-desc" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/avaliacoes', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete avaliaco" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete avaliaco',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $avaliacoes->render() !!} </div>
    </div>

</div>
@endsection
