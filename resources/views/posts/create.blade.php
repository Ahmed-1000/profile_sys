@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('postcreate')}}" enctype="multipart/form-data" method="post">
      @csrf
      <div class="row">
          <div class="col-8 offset-2">
               <div class="row ">
                        <h1 class=" pl-4">Add New Post</h1>
               </div>
              <div class="form-group">
                     
                            <label for="caption" class="col-md-4 col-form-label ">Post caption</label>

                            <div class="col-md-6">
                                <input id="caption" type="text" class="form-control  @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>

                                @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     
              </div>
              <div class=" form-group">
                   <label for="image" class="col-md-4 col-form-label ">Post Image</label>

                   <input type="file" class="form-control-file pl-2" id="image" name="image">
                   @error('image')
                                    
                                        <strong style="color:red;">{{ $message }}</strong>
                                   
                    @enderror

              </div>
              <div class="form-group pt-4">
                    <button class="btn btn-primary">Add new Post </button>
              </div>
          </div>

      </div>

    </form>
</div>
@endsection
