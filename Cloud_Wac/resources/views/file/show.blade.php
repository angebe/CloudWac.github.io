@extends('app')

@section('content')
<div class="col-sm-offset-4 col-sm-4">
	<br>
	<div class="panel panel-primary">	
		<div class="panel-heading">File :</div>
		<div class="panel-body">
			{!! csrf_field() !!}
			<p><strong>Name :</strong> {{ $file->originalName }}</p>
			<!-- <div class="form-group"> -->
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
							
								<?php
								if (strstr($file->mime, 'image')) {
									?>
									<img style="width:230px; height:220px" src="{!! asset('uploads/'.$file->user_id.'/'.$file->renamedFile) !!}" style='width:1200px; height:800px'>
									<?php
								}
								elseif(strstr($file->mime, 'audio')){
									?>
									<audio src="{!! asset('uploads/'.$file->user_id.'/'.$file->renamedFile) !!}" autobuffer autoloop loop controls></audio>
									<?php
								}
								elseif(strstr($file->mime, 'video')){
									?>
									<video controls preload>
										<source  src="{!! asset('uploads/'.$file->user_id.'/'.$file->renamedFile) !!}" type="video/mp4">
										</video>
										<?php
									}
									?>
							
						</div>
					</div>


				</div>
				<p><strong>Filesize :</strong> {{ $file->filesize }} octets</p>
				<p><strong>Mime :</strong> {{ $file->mime }}</p>
				<p><strong>Create:</strong> {{ $file->created_at }}</p>
				<!-- </div> -->
			</div>				
			<a href="javascript:history.back()" class="btn btn-primary">
				<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
			</a>
		</div>
		@stop