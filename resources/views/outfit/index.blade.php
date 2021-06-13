
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-10">
           <div class="card">
               <div class="card-header"><h1>Outfits</h1></div>
                <form action="{{route('outfit.index')}}" method="GET">
                    
                    <fieldset class="sort">
                        <legend>Sort by:</legend>
                        <div class="inputs">
                        <label for="_1">size</label><input type="radio" name="sort" value="size" @if($sort == 'size') checked @endif id="_1">
                        <label for="_2">outfit</label><input type="radio" name="sort" value="outfit" @if($sort == 'outfit') checked @endif id="_2">
                        <span class="border" ></span>
                        <label for="_3">up</label><input type="radio" name="order" value="asc" @if($order == '' ||  $order == 'asc') checked @endif checked id="_3">
                        <label for="_4">down</label><input type="radio" name="order" value="dsc"  @if($order == 'desc') checked @endif id="_4">
                        </div>
                    </fieldset>
                    
                    <fieldset class="sort">
                    <legend>Filter by:</legend>
                      <div class="inputs">
                          <select class="form-select" name="master_id">
                              <option value="0">Select</option>
                              @foreach($masters as $master)
                                <option value="{{$master->id}}" @if($master_id == $master->id) selected @endif>{{$master->name}}{{$master->surname}}
                              @endforeach
                          </select>   
                      </div>
                    </fieldset>

                <button class="btn btn-success">Sort</button>
                </form>
                <div class="card-body">       
                <ul class="list-group">
                 @forelse ($outfits as $outfit)
                <li class="list-group-item">
                    <div class="list-bin">

                        <div class="list-title">
                        {{$outfit->outfitMaster->name}} {{$outfit->outfitMaster->surname}} 
                        <span>{{$outfit->type}}</span>
                        <span>{{$outfit->size}}</span>
                        </div>

            <div class="list-buttons">
                <a class="btn btn-secondary" href="{{route('outfit.show',[$outfit])}}">
                    Show
                </a>
                <a class="btn btn-secondary" href="{{route('outfit.edit',[$outfit])}}">
                    Edit
                </a>
                <form method="POST" action="{{route('outfit.destroy', $outfit)}}">
                 @csrf
                 <button type="submit" class="btn btn-dark">DELETE</button>
                </form>
            </div>
        </div>
            </li>
              @empty
              <li class="list-group-item">
                <div class="list-bin">
                <div class="list-title">
                    nothing is there
                </div>
            </div>
        </li>
              @endforelse
            </ul>
        </div>
           </div>
       </div>
   </div>
</div>
@endsection

