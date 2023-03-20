<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use App\Helpers\APIResponseHelper;

class APIFormRequest  extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();
        throw new HttpResponseException($this->response($error));
    }

    public function response($error)
    {
        return APIResponseHelper::sendError($error, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
