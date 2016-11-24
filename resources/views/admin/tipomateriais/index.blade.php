@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Tipomateriais <a href="{{ url('/admin/tipomateriais/create') }}" class="btn btn-primary btn-xs" title="Add New tipomateriai"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Nome </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($tipomateriais as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>
                        <a href="{{ url('/admin/tipomateriais/' . $item->id) }}" class="btn btn-success btn-xs" title="View tipomateriai"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/tipomateriais/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar tipomateriai"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/tipomateriais', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete tipomateriai" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete tipomateriai',
                                    'onclick'=>'return confirm("Deseja apagar?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $tipomateriais->render() !!} </div>
    </div>

</div>
@endsection
