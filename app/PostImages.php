<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImages extends Model
{
    //
    protected $table = 'postimages';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable =['id','post_id','image'];
}
