<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //Use Compoships library to implement composite foreign keys
    use \Awobaz\Compoships\Compoships;

    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
    ];


    /**
     * This comment created by this author
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * This comment has a implied relationship with rating
     * A user comment on a post and might rate that post too.
     */

    public function rating(){
        return $this->belongsTo('App\Rating', ['user_id', 'post_id'], ['user_id', 'post_id']);
    }


}
