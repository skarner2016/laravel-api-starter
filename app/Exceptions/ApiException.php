<?php

namespace App\Exceptions;

use App\Lib\Api;
use Exception;
use Throwable;
use JetBrains\PhpStorm\Pure;
use Illuminate\Http\JsonResponse;

/**
 * Class    ApiException
 * @package App\Exceptions
 * @desc
 * @author  skarner <2022-03-24 16:36>
 */
class ApiException extends Exception
{
    /**
     * @param $code
     * @param $message
     * @param Throwable|null $previous
     */
    #[Pure] public function __construct($code = 0, $message = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @desc    返回错误码、错误信息
     * @return \Symfony\Component\HttpFoundation\JsonResponse|JsonResponse
     * @author  skarner <2022-03-24 17:05>
     */
    public function render(): \Symfony\Component\HttpFoundation\JsonResponse|JsonResponse
    {
        return Api::fail($this->getCode(), $this->getMessage());
    }
}
