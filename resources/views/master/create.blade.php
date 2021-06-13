@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header"><h1>Add new</h1></div>

               <div class="card-body">
                <form method="POST" action="{{route('master.store')}}">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="master_name" class="form-control" value="{{old('master_name')}}"
                        >
                        <small class="form-text text-muted">name</small>
                      </div>
                      <div class="form-group">
                        <label>Surname</label>
                        <input type="text" name="master_surname" class="form-control"value="{{old('master_surname')}}"
                        >
                        <small class="form-text text-muted">surname</small>
                      </div>
                    @csrf
                    <button type="submit"class="btn btn-dark">ADD</button>
                 </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
