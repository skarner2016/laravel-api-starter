<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    public function toArray($request)
    {
        // TODO:
        return [
            'id' => $this->id,
            ''
        ];
    }
}
