@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-9">
           <div class="card">
               <div class="card-header"><h1>Outfit</h1></div>             
               <div class="card-body">             
                  <ul class="list-group">
                    <li class="list-group-item">Type: {{$outfit->type}}</li>
                    <li class="list-group-item">Color: {{$outfit->color}}</li>
                    <li class="list-group-item">Size: {{$outfit->size}}</li>
                    <li class="list-group-item">About: {!!$outfit->about!!}</li>
                    <li class="list-group-item">Master: {{$outfit->outfitMaster->name}}{{$outfit->outfitMaster->surname}}</li>
                  </ul>
                  <a class="btn btn-secondary mt-4" href="{{route('outfit.edit',[$outfit])}}">
                    Edit
                </a>
                <a class="btn btn-secondary mt-4" href="{{route('outfit.pdf',[$outfit])}}">
                  Save as PDF
              </a>
               </div>
           </div>
       </div>
     </div>
  </div>
</div>
@endsection
