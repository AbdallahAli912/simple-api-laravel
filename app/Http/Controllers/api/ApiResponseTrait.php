<?php

namespace App\Http\Controllers\Api; //namespace for the api controller
use Illuminate\Support\Facades\Validator;

Trait ApiResponseTrait
{

    public $paginateNumber = 10;

    /*
     * the common response shape
     * [
        'date'=>'returned data',
        'status'=> true or false,
        'error'=> 'error message',
        '
    ]
    */

// function called when aim to respond with api
    public function apiResponse($data = null, $error = null, $code = 200)
    {
        $array = [
            'data' => $data,
            'status' => in_array($code, $this->successCode()) ? true : false,
            'error' => $error,
        ];

        return response($array, $code);
    }

    public function successCode()
    {
        return [200, 201, 202];
    }


    public function createdResponse($data)
    {
        return $this->apiResponse($data, null, 201);
    }

    public function deletedResponse()
    {
        return $this->apiResponse(true, null, 200);
    }

    public function notFoundResponse()
    {
        return $this->apiResponse(null, 'not found', 404);
    }

    public function unknownErrorResponse()
    {
        return $this->apiResponse(null, 'unknown error', 400);
    }




    public function apiValidation($request, $array)
    {
        $validator = Validator::make($request->all(), $array);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 422);
        }
    }

}