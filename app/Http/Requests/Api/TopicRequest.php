<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;

class TopicRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST'  => [
                'content' => ['required', 'string'],
            ],
            default => [],
        };
    }
}
