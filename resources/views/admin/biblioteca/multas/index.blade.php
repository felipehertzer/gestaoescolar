@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Multas <a href="{{ url('/admin/biblioteca/multas/create') }}" class="btn btn-primary btn-xs" title="Adicionar multa"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Aluno</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <th>Tipo Multa</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($multas as $item)
                {{-- */$x++;/* --}}
                <tr>                    
                    <td>{{ $x }}</td>
                    <td>{{ $item->matricula->aluno->pessoa->nome }}</td>
                    <td>{{ App\Multa::getNomeStatus($item->status) }}</td>
                    <td>R$ {{ number_format($item->valor, 2, ",", ".") }}</td>
                    <td>{{ $item->tipomulta->nome }}</td>
                    <td>
                        <a href="{{ url('/admin/biblioteca/multas/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver multa"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/multas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar multa"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/multas/' . $item->id . '/pagar_multa') }}" class="btn btn-primary btn-xs" title="Pagar multa"><span class="glyphicon glyphicon-usd" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/biblioteca/multas', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar multa" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar multa',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $multas->render() !!} </div>
    </div>

</div>
@endsection
