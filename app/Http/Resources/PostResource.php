<?php

namespace App\Http\Resources;

use App\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $favorite = Favorite::query()->where('post_id', $this->id)->where('user_id', auth()->guard('api')->user()->id)->count();
        $isFavorite = false;
        if($favorite > 0){
            $isFavorite = true;
        }

        return [
            'id'=> $this->id,
            'title'=>$this->title,
            'author_id' => $this->author['id'],
            'author_name' => $this->author['name'],
            'author_avatar' => "/storage/" . $this->author['avatar'],
            'body'=>$this->body,
            'image' =>"/storage/" . $this->image,
            'total_comments' => $this->total_comments,
            'total_ratings' => $this->total_ratings,
            'total_views' => $this->total_views,
            'avg_rating' => $this->avg_rating,
            'is_favorite' =>$isFavorite,
            'status' => $this->status,
            'updated_at'=> $this-> updated_at,
            'created_at'=> $this-> created_at
        ];
    }
}
