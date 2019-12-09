<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    public $timestamps = false;
    protected $fillable =['title','post_category'];
}
