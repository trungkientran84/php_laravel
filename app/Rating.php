<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //Use Compoships library to implement composite foreign keys
    use \Awobaz\Compoships\Compoships;

    protected $fillable = [
        'post_id',
        'user_id',
        'rating',
    ];
}
