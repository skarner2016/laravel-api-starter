<?php

namespace App\Http\Requests\Api;

use App\Services\TopicService;
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
            'GET'         => [
                'menu_id'      => ['int', 'in:' . implode(',', TopicService::MENU_LIST)],
                'per_page'     => ['int', 'min:1'],
                'current_page' => ['int', 'between:1, 25'],
            ],
            'POST', 'PUT' => [
                'content' => ['required', 'string', 'max:300'],
            ],
            default       => [],
        };
    }
}
