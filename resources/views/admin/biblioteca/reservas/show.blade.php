@extends('layouts.app')

@section('content')
<div class="container">

    <h1>reserva {{ $reserva->id }}
        <a href="{{ url('admin/biblioteca/reservas/' . $reserva->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit reserva"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/biblioteca/reservas', $reserva->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete reserva',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $reserva->id }}</td>
                </tr>
                <tr><th> Data Reserva </th><td> {{ $reserva->data_reserva }} </td></tr><tr><th> Data Agenda </th><td> {{ $reserva->data_agenda }} </td></tr><tr><th> Matricula Id </th><td> {{ $reserva->matricula_id }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
