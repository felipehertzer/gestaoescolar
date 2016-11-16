@extends('layouts.app')

@section('content')
<div class="container">

@foreach ($emprestamateriais as $e)
    <h1>emprestamateriais {{ $e->id }}    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $e->id }}</td>
                </tr>
                <tr>
                    <th>Turma - Disciplina</th><td> {{ $e->full_name }} </td>
                </tr>
                <tr>
                    <th>Material</th><td> {{ $e->material }} </td>
                </tr>
				<tr>
                    <th>Data</th><td> {{ $e->data }} </td>
                </tr>
            </tbody>
        </table>
    </div>
@endforeach
</div>

@endsection
