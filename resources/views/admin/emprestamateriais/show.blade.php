@extends('layouts.app')

@section('content')
<div class="container">

    <h1>materiasemprestado {{ $materiasemprestado->id }}
        <a href="{{ url('admin/materiasemprestado/' . $admin/materiasemprestado->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit admin/materiasemprestado"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/materiasemprestado', $materiasemprestado->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete materiasemprestado',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $materiasemprestado->id }}</td>
                </tr>
                
            </tbody>
        </table>
    </div>

</div>
@endsection
