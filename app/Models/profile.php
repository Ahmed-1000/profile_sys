<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function imageprofile(){
          $Imagepath = ($this->image) ? $this->image : 'profile/c1EZ6i7eM7Ls85IiHEI2dz44n0LswBerEKmrGNmC.jpg';

         return  '/storage/'.  $Imagepath;
    }
    public function user(){

       return $this->belongsTo(User::class); 
    }
    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
