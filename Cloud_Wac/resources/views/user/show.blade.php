@extends('app')

@section('content')
<br><br>
<div class="col-sm-offset-4 col-sm-4">
	<div class="container-fluid well span6">
		<div class="row-fluid" style="center">
			<div class="span2" >
				<img src="https://secure.gravatar.com/avatar/de9b11d0f9c0569ba917393ed5e5b3ab?s=140&r=g&d=mm" class="img-circle">
			</div>

			<div class="span8">
				<h3>{{ $user->lastname }}</h3>
				<h3>{{ $user->name }}</h3>
				<h3>{{ $user->birthdate }}</h3>
				<h5>Id n° {{ $user->id }}</h5>
				<h6>Email : {{ $user->email }}</h6>
				<h6>Last Modification : {{ $user->updated_at }}</h6>
			</div>

			<div class="span2">
				<div class="btn-group">
					<a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
						Action 
						<span class="icon-cog icon-white"></span><span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
					<li><a href='{{ $user->id }}/edit'><span class="icon-wrench"></span> Modify</a></li>
						<li><a href=""><span class="icon-trash"></span> Delete</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<a href="javascript:history.back()" class="btn btn-primary">
	<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
</a>
</div>
@stop
