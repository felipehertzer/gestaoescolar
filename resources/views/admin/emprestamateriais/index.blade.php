@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Empresta Materiais <a href="{{ url('/admin/emprestamateriais/create') }}" class="btn btn-primary btn-xs" title="Add New admin.emprestamateriais"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Turma - Disciplina</th><th>Material</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($emprestamateriais as $item)
                <tr>
                   <td>{{ $item->id }}</td><td>{{ $item->full_name }}</td><td>{{ $item->material }}</td>
                    
                    <td>
                        <a href="{{ url('/admin/emprestamateriais/' . $item->id) }}" class="btn btn-success btn-xs" title="View admin.emprestamateriais"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                         <a href="{{ url('/admin/emprestamateriais/' . $item->id . '/devolve') }}" class="btn btn-primary btn-xs" title="Devolver"><span class="glyphicon glyphicon-check" aria-hidden="true"/></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $emprestamateriais->render() !!} </div>
    </div>

</div>
@endsection
