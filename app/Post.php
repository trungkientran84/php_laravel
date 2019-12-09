<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'author_id',
        'category_id',
        'title',
        'seo_title',
        'excerpt',
        'body',
        'image',
        'slug',
        'meta_description',
        'meta_keywords',
        'status',
        'featured',
        'created_at',
        'updated_at',
        'total_comments',
        'avg_rating',
        'address',
        'longitude',
        'latitude',
        'total_views',
        'total_ratings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    /**
     * This post has many to one relationship with user table
    */
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * This post has one-to-many relationship with comment model
    */
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    /**
     * This post has on-to-many relationship with rating model
     */

    public function ratings(){
        return $this->hasMany("App\Rating");
    }

    /**
     * This post has on-to-many relationship with PostView model
     */

    public function views(){
        return $this->hasMany("App\PostView");
    }

    /**
     * This post has on-to-many relationship with Image model
     */

    public function images(){
        return $this->hasMany("App\Image");
    }

    /**
     * This post has on-to-many relationship with Detail model
     */

    public function details(){
        return $this->hasMany("App\PostDetail");
    }


}
