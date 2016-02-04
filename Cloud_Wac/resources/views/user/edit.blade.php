@extends('app')

@section('content')
<div class="col-sm-offset-4 col-sm-4">
	<br>
	<div class="panel panel-info">	
		<div class="panel-heading">Modification d'un utilisateur</div>
		<div class="panel-body"> 
			<div class="col-sm-12">
				{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
				<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
					<div>Username :</div>
					{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
					{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
				</div>
				<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
					<div>Name :</div>
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
					{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
				</div>
				<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
					<div>Email :</div>
					{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
					{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
				</div>
				<div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
					<div>Password :</div>
					{!! Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'Password']) !!}
					{!! $errors->first('password', '<small class="help-block">:message</small>') !!}
				</div>
				<div class="form-group">
					<div>Confirm password :</div>
					{!! Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'Password']) !!}
					{!! $errors->first('password', '<small class="help-block">:message</small>') !!}
				</div>
				{!! Form::submit('Envoyer', ['class' => 'btn btn-info pull-right']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<a href="javascript:history.back()" class="btn btn-info">
		<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
	</a>
</div>
@stop