<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FloorImage extends Model
{
    //
    protected $fillable = [
        'image_name', 'image_size', 'property_id'
    ];
}
