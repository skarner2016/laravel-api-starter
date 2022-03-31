<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'user_id'   => $this->user_id,
            'content'   => $this->content,
            'hot'       => $this->hot,
            'is_top'    => $this->is_top,
            'is_digest' => $this->is_digest,

            'comments' => $this->formatComments($this->comments),
        ];
    }

    private function formatComments($comments)
    {
        $data = [];
        foreach ($comments as $comment) {

        }

        return $data;
    }
}
