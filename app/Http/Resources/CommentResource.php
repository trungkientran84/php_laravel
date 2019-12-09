<?php

namespace App\Http\Resources;

use App\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'author'=> $this->author["name"],
            'avatar'=> "/storage/".$this->author["avatar"],
            'comment'=>$this->comment,
            'rating'=>$this->rating["rating"],
            'updated_at'=> $this-> updated_at
        ];
    }
}
