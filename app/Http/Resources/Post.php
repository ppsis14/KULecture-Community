<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
	        'id' => $this->id,
            'post_tile' => $this->post_title,
            'category' => $this->category,
            'post_tag' => $this->post_tag,
	        'created_at' => $this->created_at
	    ];
    }
}
