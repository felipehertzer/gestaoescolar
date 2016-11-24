@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Reservas <a href="{{ url('/admin/biblioteca/reservas/create') }}" class="btn btn-primary btn-xs" title="Add New reserva"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> Data Reserva </th>
                    <th> Data Agenda </th>
                    <th> Aluno </th>
                    <th> Status </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($reservas as $item)
            {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->data_reserva->format('d/m/Y') }}</td>
                    <td>{{ $item->data_agenda->format('d/m/Y') }}</td>
                    <td>{{ $item->matricula->aluno->pessoa->nome }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ url('/admin/biblioteca/reservas/' . $item->id) }}" class="btn btn-success btn-xs" title="View reserva"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/reservas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar reserva"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/biblioteca/reservas/' . $item->id . '/retirou_exemplares') }}" class="btn btn-primary btn-xs" title="Retirar Exemplares"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/biblioteca/reservas', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete reserva" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete reserva',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $reservas->render() !!} </div>
    </div>

</div>
@endsection
