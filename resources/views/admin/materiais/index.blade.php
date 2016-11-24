@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Materiais <a href="{{ url('/admin/materiais/create') }}" class="btn btn-primary btn-xs" title="Adicionar materiai"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Nome </th><th>Ações</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($materiais as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>
                        <a href="{{ url('/admin/materiais/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver materiai"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/materiais/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar materiai"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/materiais', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar materiai" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Apagar materiai',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $materiais->render() !!} </div>
    </div>

</div>
@endsection
