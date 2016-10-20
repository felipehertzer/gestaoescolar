@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit presenca </h1>

    {!! Form::model($presenca, [
        'method' => 'PATCH',
        'url' => ['/admin/presencas', $presenca[0]->id_presenca ],
        'class' => 'form-horizontal'
    ]) !!}

                    <div class="form-group {{ $errors->has('data') ? 'has-error' : ''}}">
                {!! Form::label('data', 'Data', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('data', $presenca[0]->data, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th> Nome </th>
                    <th> Matricula </th>
                    <th> Presença </th>
                </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($presenca as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td>{{ $x }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->id }}</td>
                        <td>
                            <div class="checkbox">
                                <label>{!! Form::radio('presenca['.$item->id.']', '1', $item->presenca == "presente" ? true : false) !!} Sim</label>
                                <label>{!! Form::radio('presenca['.$item->id.']', '0', $item->presenca == "presente" ? false : true) !!} Não</label>
                            </div>
                            {!! $errors->first('presenca', '<p class="help-block">:message</p>') !!}
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