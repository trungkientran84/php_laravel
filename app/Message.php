<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'messages';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable=['content','created_user_id','recipient_id','status'];
    public function Author(){
        return $this->belongsTo('App\User','created_user_id');
    }
    public function Receiver(){
        return $this->belongsTo('App\User','recipient_id');
    }
}
