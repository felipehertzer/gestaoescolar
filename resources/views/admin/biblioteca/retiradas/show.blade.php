@extends('layouts.app')

@section('content')
<div class="container">

    <h1>retirada {{ $retirada->id }}
        <a href="{{ url('admin/biblioteca/retiradas/' . $retirada->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit retirada"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/biblioteca/retiradas', $retirada->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete retirada',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $retirada->id }}</td>
                </tr>
                <tr>
                    <th> Data Retirada </th><td> {{ $retirada->data_retirada }} </td>
                </tr>
                <tr>
                    <th> Data Devolucao </th><td> {{ $retirada->data_devolucao }} </td>
                </tr>
                <tr>
                    <th> Renovacao </th><td> {{ $retirada->renovacao }} </td>
                </tr>
                <tr>
                    <th> Status </th><td> {{ App\Retirada::getNomeStatus($retirada->status) }} </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="exemplares">
        <h2>Exemplares Retirados</h2>
        @foreach($retirada->exemplares as $exemplar)
            <span> {{ $exemplar->livro->nome }} </span> <br />
        @endforeach
    </div>
    

</div>
@endsection
