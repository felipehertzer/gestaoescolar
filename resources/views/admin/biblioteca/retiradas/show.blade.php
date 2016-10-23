@extends('layouts.app')

@section('content')
<div class="container">

    <h1>retirada {{ $retirada->id }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $retirada->id }}</td>
                </tr>
                <tr>
                    <th> Data Retirada </th><td> {{ $retirada->data_retirada->format('d/m/Y') }} </td>
                </tr>
                <tr>
                    <th> Data Devolucao </th><td> {{ $retirada->data_devolucao->format('d/m/Y') }} </td>
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
            <span> Livro: {{ $exemplar->livro->nome }} - Exemplar: {{ $exemplar->id }} </span> <br />
        @endforeach
    </div>
    

</div>
@endsection
