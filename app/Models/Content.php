<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
     public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function itineraries()
{
    return $this->belongsToMany(Itinerary::class, "content_itinerary");
}
}
