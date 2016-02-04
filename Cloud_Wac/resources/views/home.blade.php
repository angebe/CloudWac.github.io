@extends('app')

@section('content')
</head>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">Yes We Can!</div>
    <!--   <div class="panel-body"> -->
          {!! csrf_field() !!}
            <div class="dropzone" id="dropzoneFileUpload">
            </div>
          </div>


          <script type="text/javascript">
            var baseUrl = "{{ url('/') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("div#dropzoneFileUpload", {
             url: baseUrl+"/uploadFiles",
             params: {
              _token: token
            }
          });
            Dropzone.options.myAwesomeDropzone = {
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 10, // MB
                addRemoveLinks: true,
                accept: function(file, done) {

                },
              };
            </script>
          <!-- </div> -->
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading" style="font-weight:bold"><h1 style="margin:0">Listes des fichiers</h1></div>
            <div class="panel-body">
              <table class="table table-responsive">
                <tr>
                  <th class="table-bordered" style="text-align: center">Nom du fichier</th>
                  <th class="table-bordered" style="text-align: center">Type de fichier</th>
                  <th class="table-bordered" style="text-align: center">Modifier</th>
                </tr>
                @foreach ($files as $file)               
                <tr class="table-bordered">
                  <td class="table-bordered">{!! $file->renamedFile !!}</td>
                  <td class="table-bordered">{!! $file->mime !!}</td>
                  <td class="table-bordered">
                    <a href='uploadfiles/info/{!! $file->id !!}'><button class="btn btn-primary" style="margin:10px">Info</button></a>
                    <a href='{{asset('uploads/'. Auth::user()->id. '/' . $file->renamedFile) }}' download="{{ $file->renamedFile}}"><button class="btn btn-default" style="margin:10px">Download</button></a>
                    <a href='uploadfiles/edit/{!! $file->id !!}'><button class="btn btn-info" style="margin:10px">Edit</button></a>
                    <a href='uploadfiles/delete/{!! $file->id !!}'><button class="btn btn-danger" style="margin:10px">Delete</button></a>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
      @endsection
