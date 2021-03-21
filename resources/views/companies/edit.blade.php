@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{$error}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Company</div>

                <div class="card-body">

                    <form method="POST" action="{{ url('company/edit/' . $company_data->id) }}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name" value="{{ !empty($company_data->name) ? $company_data->name : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Company Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Company email" value="{{ !empty($company_data->email) ? $company_data->email : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Company Photo</label>
                            <div class="col-md-12">
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <input type="file" name="photo" class="form-control-file" id="photo" onchange="loadFile(event)">
                                    </div>
                                </div>
                                <div class="col-md-4" id="photo_div">
                                    <img id="output" src="{{ !empty($company_data->photo) ? $company_data->photo : '' }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="website">Company Website</label>
                            <input type="text" class="form-control" id="website" name="website" placeholder="Enter Company Website" value="{{ !empty($company_data->website) ? $company_data->website : '' }}">
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

</script>
@endsection
