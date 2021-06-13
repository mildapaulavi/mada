

 @extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-9">
           <div class="card">
               <div class="card-header"><h1>Create new outfit</h1></div>

               <div class="card-body">
                   
                <form method="POST" action="{{route('outfit.store')}}">
                    <div class="form-group">
                        <label>Type</label>
                        <input type="text" name="outfit_type" class="form-control">
                        <small class="form-text text-muted">Type</small>
                      </div>
                      <div class="form-group">
                        <label>Color</label>
                        <input type="text" name="outfit_color"class="form-control">
                        <small class="form-text text-muted">Color</small>
                      </div>
                      <div class="form-group">
                        <label>Size</label>
                        <input type="text" name="outfit_size"class="form-control">
                        <small class="form-text text-muted">Size </small>
                      </div>
                      <div class="form-group">
                        <label>About</label>
                        <textarea name="outfit_about" id="summernote"></textarea>
                        <small class="form-text text-muted">About</small>
                      </div>

                      <div class="form-group">
                    <select class="fomr-select" name="master_id"> 
                      <option value="0">Select</option>
                        @foreach ($masters as $master)
                            <option value="{{$master->id}}">{{$master->name}} {{$master->surname}}</option>
                        @endforeach
                 </select>
                      </div>
                    @csrf
                    <button type="submit" class="btn btn-dark">ADD</button>
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
