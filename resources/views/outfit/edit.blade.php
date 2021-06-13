
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header"><h1>Edit</h1></div>
               
               <div class="card-body">
                <form method="POST" action="{{route('outfit.update',[$outfit])}}">
                    <div class="form-group">
                        <label>Type</label>
                        <input type="text" name="outfit_type" class="form-control" value="{{$outfit->type}}">
                        <small class="form-text text-muted"></small>
                      </div>
                      <div class="form-group">
                        <label>Color</label>
                        <input type="text" name="outfit_color"class="form-control"value="{{$outfit->color}}">
                        <small class="form-text text-muted"></small>
                      </div>
                      <div class="form-group">
                        <label>Size</label>
                        <input type="text" name="outfit_size"class="form-control"value="{{$outfit->size}}">
                        <small class="form-text text-muted"></small>
                      </div>
                      <div class="form-group">
                        <label>About</label>
                        <textarea name="outfit_about" id="summernote" {{$outfit->about}}></textarea>
                        <small class="form-text text-muted"></small>
                      </div>
                    
                      <div class="form-group">
                        <select class="fomr-select" name="master_id">  
                            @foreach ($masters as $master)
                                <option value="{{$master->id}}">{{$master->name}} {{$master->surname}}</option>
                            @endforeach
                     </select>
                          </div>
                        @csrf
                        <button type="submit" class="btn btn-dark">Edit</button>
                     </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
  $(document).ready(function() {
     $('#summernote').summernote();
   });
  </script>
  
@endsection
