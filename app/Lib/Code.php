<?php

namespace App\Lib;

use Illuminate\Support\Arr;

/**
 * 返回状态码(业务代码)
 * Class Code
 * @package App\Lib
 */
class Code
{
    // 错误代码
    const SUCCESS = 200;
    const ERROR   = 500;

    const PARAM_ERROR = 10001;

    /**
     * 错误信息
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            self::SUCCESS => '请求成功',
            self::ERROR   => '网络错误', // ^_^

            self::PARAM_ERROR => '参数错误'
        ];
    }

    /**
     * 获取错误信息
     * @param int $code
     * @return string
     */
    public static function getMessage(int $code): string
    {
        $messages = (new self())->messages();

        return Arr::get($messages, $code, 'network error');
    }
}
