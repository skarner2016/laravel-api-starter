<?php

namespace App\Lib;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 统一返回
 * Class Api
 * @package App\Lib
 */
class Api
{
    /**
     * 请求成功返回
     * @param array $data
     * @return \Illuminate\Http\JsonResponse|JsonResponse
     */
    public static function success($data = [])
    {
        $response = [
            'code'    => Code::SUCCESS,
            'message' => 'success',
            'data'    => $data,
        ];

        // collection
        if ($data instanceof ResourceCollection && $data->resource instanceof LengthAwarePaginator) {
            $resource         = $data->resource;
            $response['meta'] = [
                'page'      => $resource->currentPage(),
                'per_page'  => $resource->perPage(),
                'total'     => $resource->total(),
                'last_page' => $resource->lastPage(),
                //                'path'      => $resource->path(),
            ];
        }

        // paginator
        if ($data instanceof LengthAwarePaginator) {
            $response['data'] = $data->items();
            $response['meta'] = [
                'page'      => $data->currentPage(),
                'per_page'  => $data->currentPage(),
                'total'     => $data->total(),
                'last_page' => $data->lastPage(),
                //                'path'      => $data->path(),
            ];
        }

        return self::responseJson($response);
    }

    /**
     * 请求失败返回
     * @param null $code
     * @param null $message
     * @return \Illuminate\Http\JsonResponse|JsonResponse
     */
    public static function fail($code = null, $message = null)
    {
        $code     = $code ? $code : Code::ERROR;
        $response = [
            'code'    => $code,
            'message' => $message ? $message : Code::getMessage($code),
        ];

        return self::responseJson($response);
    }

    /**
     * 统一返回
     * @param array $response
     * @return \Illuminate\Http\JsonResponse|JsonResponse
     */
    public static function responseJson(array $response)
    {
        return response()->json($response)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
