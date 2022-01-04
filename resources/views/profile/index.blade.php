@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 ">
             <img src="{{$User->profile->imageprofile() }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pl-5 pt-5">
              <div class="d-flex justify-content-between">
              <div class="d-flex align-items-center pb-3">
                 <div class="h4">{{ $User->username ?? 'TYLER' }}</div>

                 <div id="app">
                     <FollowButton user-id="{{$User->id}}"  />
                 </div>
                 

              </div>
                
                 @can('update',$User->profile)
                     <a href="{{route('postc')}}">Add new post</a>
                 @endcan
                
                 
              </div>
              @can('update',$User->profile)
               <a href="/profile/{{$User->id}}/Edit">Edit profile</a>
              @endcan
              @if($User->id != auth()->id())
              <div><a href="/home/chat/{{$User->id}}">message</a></div>
              @endif
              <div class="d-flex">
                 <div class="pr-5"><strong>{{$User->post->count()}}</strong>posts</div>
                 <div class="pr-5"><strong>23k</strong>followers</div>
                 <div class="pr-5"><strong>22</strong>following</div>
              </div>
              <div class="pt-4 font-weight-bold">{{$User->profile->title ?? 'TYLERCOURSE'}}</div>
              <div>{{$User->profile->description ?? 'description here'}}</div>
              <div><a href="#">{{$User->profile->url ?? 'N/A'}} </a></div>
        </div>
    </div>
    <div class="row pt-5">
      
         @foreach($User->post as $posts)
             <div class="col-4">
               <a href="/post/{{$posts->id}}">
                 <img src="/storage/{{ $posts->image  }}" class="w-100">
               </a>
             </div>
         @endforeach
         
         
    </div>
</div>
@endsection
