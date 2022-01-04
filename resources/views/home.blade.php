@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($post as $post)
       <div class="row">
          <div class="col-8">
                <img src="/storage/{{ $post->image }}" style="width:600px; height:500px;" alt="">
          </div>
          <div class="col-4">
             <div>
                 <div class="d-flex align-items-center">
                     <div class="pr-3">
                           <img src="{{ $post->user->profile->imageprofile() }}" class="rounded-circle w-100" style="max-width:50px;">
                     </div>
                     <div>
                        <div class="font-weight-bold" style="user-select:none;">
                             <a href="/profile/{{$post->user->id}}">
                                <span class="text-dark">{{$post->user->username}}</span>
                            </a> 
                            <a href="#" class="pl-3">Follow</a>
                        </div>
                     </div>
                 </div>
                 <hr>

                  <p>{{$post->caption}}</p>
             </div>
          </div>
     </div>
   @endforeach
</div>
@endsection
