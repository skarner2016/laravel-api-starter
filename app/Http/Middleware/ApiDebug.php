<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * 记录请求、返回参数
 * Class ApiDebug
 * @package App\Http\Middleware
 */
class ApiDebug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 非 debug 配置，不记录
        if (! env('APP_DEBUG')) {
            return $next($request);
        }

        // 处理请求
        $response = $next($request);

        // 记录日志
        $this->sendLog($request, $response);

        return $response;
    }

    /**
     * 写入日志
     * @param Request $request
     * @param $response
     */
    private function sendLog(Request $request, $response)
    {
        $log = PHP_EOL . $request->url();

        // 请求参数
        if (!empty($request->all())) {
            $log .= '?' . http_build_query($request->all());
        }

        // 返回参数
        if ($response instanceof JsonResponse) {
            $log .= PHP_EOL . $response->content();
        }

        Log::channel('debug')->debug($log . PHP_EOL);
    }
}
