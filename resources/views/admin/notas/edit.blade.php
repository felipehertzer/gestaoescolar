@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Alunos</h1>

    {!! Form::model($alunos, [
        'method' => 'PATCH',
        'url' => ['/admin/notas', $id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th>
                <th> Nome </th>
                <th> Matricula </th>
                <th> Nota </th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($alunos as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->id }}</td>
                    <td style="width:120px;">
                        {!! Form::text('notas['.$item->id.']', number_format($item->nota, 2), ['class' => 'form-control']) !!}
                        {!! $errors->first('notas', '<p class="help-block">:message</p>') !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection