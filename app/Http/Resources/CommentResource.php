<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * @desc    格式化输出
     * @param $request
     * @return array
     * @author  skarner <2022-04-01 10:59>
     */
    public function toArray($request): array
    {
        return [
            'id'                  => $this->id,
            'topic_id'            => $this->topic_id,
            'name'                => $this->user->name,
            'head_img'            => $this->user->head_img,
            'content'             => $this->content,
            'is_digest'           => $this->is_digest,
            'reply_user_name'     => $this->replyUser->name,
            'reply_user_head_img' => $this->replyUser->head_img,
            'created_at'          => $this->created_at->timestamp,
        ];
    }
}
