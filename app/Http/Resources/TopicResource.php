<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TopicResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // TODO:
        dd(__METHOD__, $this->collection);

        return [
            'id'        => $this->id,
            'user_id'   => $this->user_id,
            'content'   => $this->content,
            'hot'       => $this->hot,
            'is_top'    => $this->is_top,
            'is_digest' => $this->is_digest,
        ];

        // return parent::toArray($request);
    }
}
