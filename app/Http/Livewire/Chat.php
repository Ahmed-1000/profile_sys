<?php

namespace App\Http\Livewire;

use  Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\message;

class Chat extends Component
{
    public $message;
    public $allmessage;
    public $sender;
    public function render()
    {
        $users = User::all();
        $sender=$this->sender;
        $this->allmessage;
        return view('livewire.chat', compact('users','sender'));
    }
    public function mountdata(){
         $authinId = auth()->id();
        if(isset($this->sender->id)){
              $this->allmessage = message::where('user_id', $authinId)
                ->where('receiver_id',$this->sender->id)->orWhere('user_id',$this->sender->id)
                ->where('receiver_id', $authinId)->orderBy('id','desc')->get();

              $not_seen = message::where('user_id',$this->sender->id)
                             ->where('receiver_id', auth()->id())->where('is_seen', false);
              $not_seen->update(['is_seen'=> true]);
            
        }
    }
   
    public function resetform(){
        $this->message='';
    }
    public function SendMessage(){
         $data = new message;
         $data->message = $this->message;
         $data->user_id = Auth::user()->id;
         $data->receiver_id = $this->sender->id;
         $data->save();

         $this->resetform();
    }
    public function getuser($userId){
       $user=User::find($userId);

       $this->sender=$user;
       $authinId = auth()->id();
       $this->allmessage = message::where('user_id', $authinId)
       ->where('receiver_id',$userId)->orWhere('user_id',$userId)
       ->where('receiver_id', $authinId)->orderBy('id','desc')->get();
    }
    public function delete($userId){
        $data = message::find($userId)->delete();
    }
}
