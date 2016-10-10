@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Presencas  <a href="{{ url('/admin/presencas/'.$id.'/create') }}" class="btn btn-primary btn-xs" title="Add New presenca"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th> Data </th><th> Presentes </th><th> Faltantes </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($presencas as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $item->data }}</td>
                    <td>{{ $item->presentes }}</td>
                    <td>{{ $item->faltantes }}</td>
                    <td>
                        <a href="{{ url('/admin/presencas/' . $id. '/edit' ) }}" class="btn btn-primary btn-xs" title="Fazer presenca"><span class="fa fa-bullhorn" aria-hidden="true"/></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $presencas->render() !!} </div>
    </div>

</div>
@endsection
