
<div>
  <div class="container">
    <div class="row justify-content-center">
         <div class="col-md-4">
               <div class="card">
                   <div class="card-header">
                       users
                   </div>
                   <div class="card-body chatbox p-0">
                        <ul class="list-group list-group-flush">
                          
                          @foreach($users as $user)
                          @if($user->id !== auth()->id())
                          @php
                             $not_seen = App\Models\message::where('user_id',$user->id)
                             ->where('receiver_id', auth()->id())->where('is_seen', false)->get() ?? null
                          @endphp
                           <a wire:click="getuser({{$user->id}})" class="text-dark link">
                            <li class="list-group-item" style="cursor:pointer;">
                              @if($user->is_online == true)
                               <i class="fa fa-circle text-success online-icon">
                              @endif
                               </i>
                                 {{$user->username}}
                                 @if(filled($not_seen))
                                 <div class="badge badge-success rounded">{{ $not_seen->count() }}</div>
                                 @endif
                            </li>
                          </a>
                          @endif
                         @endforeach
                        </ul>
                   </div>
               </div>
         </div>
         <div class="col-md-8 @if(isset($sender->name) || isset($userfind->id)) show  @else hide @endif">
           
             <div class="card">
                  <div class="card-header">
                      @if(isset($sender) || isset($userfind->id)) {{$sender->name  }}  @endif
                  </div>
                  <div class="card-body message-box " wire:poll="mountdata" style="height:500px;  overflow:auto;">
                   @if(filled($allmessage))
                    @foreach($allmessage as $msg)
                      <div class="single-message @if($msg->user_id ==
                      auth()->id()) sent @else received @endif"
                      style="padding:10px; margin-top:12px;  width:220px; border-radius:25px;">
                         <p class="font-weight-border my-0">{{$msg->User->username}}</p>
                         {{$msg->message}}
                         <br><small class="text-muted w-100">Sent <em>{{$msg->created_at}}</em></small>
                        @if(auth()->id() == $msg->user_id)
                         <a style="color:red; cursor:pointer;" wire:click="delete({{$msg->id}})">Delete</a>
                        @endif
                      </div>
                    @endforeach
                    @endif
                  </div>
                  <div class="card-footer">
                      <form wire:submit.prevent="SendMessage">
                         <div class="row">
                              <div class="col-md-8">
                                   <input type="text" wire:model="message" class="form-control input shadow-none w-100 d-inline-block" placeholder="Type a message" required>
                              </div>
                              <div class="col-md-4">
                                 <button class="btn btn-primary d-inline-block w-100" type="submit"><i class="far fa-paper-plane"></i>send</button>
                              </div>
                         </div>
                           
                            
                      </form>
                  </div>
             </div>
         
         </div>
    </div>
  </div>
</div>
