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
                <tr>
                    <th> Data Reserva </th><td> {{ $reserva->data_reserva->format('d/m/Y') }} </td>
                </tr>
                <tr>
                    <th> Data Agenda </th><td> {{ $reserva->data_agenda->format('d/m/Y') }} </td>
                </tr>
                <tr>
                    <th> Aluno </th><td> {{ $reserva->matricula->aluno->pessoa->nome }} </td>
                </tr>
                <tr>
                    <th> Status </th><td> {{ $reserva->status }} </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="autores">
        <h2>Exemplares Reservados</h2>
        @foreach($reserva->exemplares as $exemplar)
            <span> L: {{ $exemplar->livro->nome }} - Ex: {{ $exemplar->id }}</span> <br />
        @endforeach
    </div>

</div>
@endsection
