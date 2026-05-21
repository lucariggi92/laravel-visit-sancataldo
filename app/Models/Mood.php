<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    public function contents(){
        
     return $this->belongsToMany(Content::class, 'content_mood');
    }
        
}
    
   
