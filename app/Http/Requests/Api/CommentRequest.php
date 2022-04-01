<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;

class CommentRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'GET'   => [
                'topic_id'     => ['required', 'int', 'min:1'],
                'comment_id'   => ['int', 'min:1'],
                'per_page'     => ['int', 'min:1'],
                'current_page' => ['int', 'between:1, 25'],
            ],
            'POST'  => [
                'topic_id'   => ['required', 'int', 'min:1'],
                'comment_id' => ['int', 'min:1'],
                'content'    => ['string', 'max:300'],
            ],
            'PUT'   => [
                'content'    => ['string', 'max:300'],
            ],
            default => [],
        };
    }
}
