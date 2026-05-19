<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    public function contents(){
        return $this->belongsToMany(Content::class);
    }
}
