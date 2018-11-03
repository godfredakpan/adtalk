
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Upload Files</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

</head>
<style type="text/css">
  .help-block{
    color: red;
  }
  input{
    margin-bottom:10px !important;
  }
</style>
@include('inc.navbar')
<body>

  <div class="container">
  <div class="col-md-12">        

    <h2 style="text-align:center;">Upload Video</h2><br>
 
  {!! Form::open(array('url'=>'insertfile','method'=>'POST' ,'class'=>'form-horizontal','files'=>true)) !!}

  <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">

      <label class="control-label col-sm-2" for="name">Video Title:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control file_title_c" id="file_title_id" name="file_title" placeholder="Enter Title"  value="{{ Input::old('file_title') }}">
        @if ($errors->has('file_title')) <p class="help-block">{{ $errors->first('file_title') }}</p> @endif

    </div>
    <label class="control-label col-sm-2" for="name">Survey Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control survey_name_c" id="survey_name_id" name="survey_name" placeholder="Enter Survey Name"  value="{{ Input::old('survey_name') }}">
        
				</div>
        <label class="control-label col-sm-2" for="name">Survey Description:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control survey_description_c" id="survey_description_id" name="survey_description" placeholder="Enter Survey Description"  value="{{ Input::old('survey_description') }}">
        
				</div>
     
      </div>

      <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Upload:</label>
  
      <div class="col-sm-4">          
      
        <input type="file"  name="filenam" class="filename">

        @if ($errors->has('filenam')) <p class="help-block">{{ $errors->first('filenam') }}</p> @endif

      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>

    </div>

    
{!! Form::close() !!}

</div>
</div>
 


<script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>

</body>
</html>