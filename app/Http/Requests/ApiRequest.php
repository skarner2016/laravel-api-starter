<?php

namespace App\Http\Requests;

use App\Lib\Code;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @desc    表单验证失败，返回信息
     * @param Validator $validator
     * @return \Symfony\Component\HttpFoundation\JsonResponse|JsonResponse
     * @author  skarner <2022-03-24 16:25>
     */
    public function failedValidation(Validator $validator): \Symfony\Component\HttpFoundation\JsonResponse|JsonResponse
    {
        $response = response()->json([
            'code' =>  Code::PARAM_ERROR,
            'message' => $validator->errors()->first(),
        ]);

        throw new HttpResponseException($response);
    }
}
