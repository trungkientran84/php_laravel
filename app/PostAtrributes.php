<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostAtrributes extends Model
{
    //
    protected $table = 'postattributes';
    protected $primaryKey = 'post_attributeid';
    public $timestamps = false;
    protected $fillable =['post_id','attribute_id','value'];
}
