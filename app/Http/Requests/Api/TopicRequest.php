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
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [
                    'menu_id'      => ['int', 'in:' . implode(',', TopicService::MENU_LIST)],
                    'per_page'     => ['int', 'min:1'],
                    'current_page' => ['int', 'between:1, 25'],
                ];
            case 'POST':
            case 'PUT':
                return [
                    'content' => ['required', 'string', 'max:300'],
                ];
            default:
                return [];
        }
    }
}
