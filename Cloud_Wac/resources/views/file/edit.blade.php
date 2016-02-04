@extends('app')

@section('content')
<div class="col-sm-offset-4 col-sm-4">
	<br>
	<div class="panel panel-info">	
		<div class="panel-heading">Modification d'un upload</div>
		<div class="panel-body"> 
			<div class="col-sm-12">
				<div class="form-group {!! $errors->has('renamedFile') ? 'has-error' : '' !!}">
				{!! csrf_field() !!}
				{!! Form::open(array('routes' => 'uploadfiles/edit'))!!}
				{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
					{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
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