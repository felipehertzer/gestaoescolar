@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar pessoa {{ $pessoa->id }}</h1>

    {!! Form::model($pessoa, [
        'method' => 'PATCH',
        'url' => ['/admin/pessoas', $pessoa->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
                {!! Form::label('nome', 'Nome', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('cpf') ? 'has-error' : ''}}">
                {!! Form::label('cpf', 'Cpf', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('cpf', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('cpf', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('sexo') ? 'has-error' : ''}}">
                {!! Form::label('sexo', 'Sexo', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('sexo', get_enum_values('pessoa', 'sexo'), null, ['class' => 'form-control']) !!}
                    {!! $errors->first('sexo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('dataNascimento') ? 'has-error' : ''}}">
                {!! Form::label('dataNascimento', 'Datanascimento', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('dataNascimento', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('dataNascimento', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('telefoneFixo') ? 'has-error' : ''}}">
                {!! Form::label('telefoneFixo', 'Telefonefixo', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('telefoneFixo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('telefoneFixo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('telefoneCelular') ? 'has-error' : ''}}">
                {!! Form::label('telefoneCelular', 'Telefonecelular', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('telefoneCelular', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('telefoneCelular', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                {!! Form::label('status', 'Status', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('status', get_enum_values('pessoa', 'status'), null, ['class' => 'form-control']) !!}
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('endereco') ? 'has-error' : ''}}">
                {!! Form::label('endereco', 'Endereco', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('endereco', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('endereco', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('tipopessoa', 'Tipo', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('tipopessoa', ['funcionario', 'professor', 'responsavel', 'aluno'] , null, ['class' => 'form-control', 'id' => 'tipopessoa']) !!}
                </div>
            </div>
            <div id="funcoes" class="form-group {{ $errors->has('funcao') ? 'has-error' : ''}}">
                {!! Form::label('funcao', 'Funcao', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('funcao', $funcoes, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('funcao', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div id="professor_funcionario">
                <div class="form-group {{ $errors->has('pis') ? 'has-error' : ''}}">
                    {!! Form::label('pis', 'PIS', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('pis', ((!empty($funcionario))?$funcionario[0]->pis:((!empty($professor))?$professor[0]->pis:'')), ['class' => 'form-control']) !!}
                        {!! $errors->first('pis', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('salario') ? 'has-error' : ''}}">
                    {!! Form::label('salario', 'Salario', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('salario', ((!empty($funcionario))?$funcionario[0]->salario:((!empty($professor))?$professor[0]->salario:'')), ['class' => 'form-control']) !!}
                        {!! $errors->first('salario', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
			
            <div id="responsavel" style="display:none;">
                <div class="form-group {{ $errors->has('empresa') ? 'has-error' : ''}}">
                    {!! Form::label('empresa', 'Empresa', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('empresa', (!empty($responsavel))?$responsavel[0]->empresa:'', ['class' => 'form-control']) !!}
                        {!! $errors->first('empresa', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div id="aluno" style="display:none;">
                <div class="form-group {{ $errors->has('observacoes') ? 'has-error' : ''}}">
                    {!! Form::label('observacoes', 'Observacoes', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('observacoes', (!empty($aluno))?$aluno[0]->observacoes:'', ['class' => 'form-control']) !!}
                        {!! $errors->first('observacoes', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
			
			
	


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Atualizar', ['class' => 'btn btn-primary form-control']) !!}
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