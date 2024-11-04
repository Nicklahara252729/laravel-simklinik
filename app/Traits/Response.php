<?php

namespace App\Traits;

trait Response
{
    /**
     * http status code
     */
    private function httpStatusCode(int $httpStatusCode)
    {
        $key  = "code";
        $data = [
            [
                'code'    => 200,
                'message' => "OK"
            ],
            [
                'code'    => 201,
                'message' => "Created"
            ],
            [
                'code'    => 304,
                'message' => "Not Modified"
            ],
            [
                'code'    => 400,
                'message' => "Bad Request"
            ],
            [
                'code'    => 401,
                'message' => "Unauthorized"
            ],
            [
                'code'    => 403,
                'message' => "Forbidden"
            ],
            [
                'code'    => 404,
                'message' => "Not Found"
            ],
            [
                'code'    => 409,
                'message' => "Conflict"
            ],
            [
                'code'    => 500,
                'message' => "Internal Server Error"
            ]
        ];

        $filteredArray = array_filter($data, function ($item) use ($key, $httpStatusCode) {
            return $item[$key] === $httpStatusCode;
        });

        return ucwords(array_values($filteredArray)[0]['message']);
    }


    /**
     * format response
     */
    private function sendResponse($message, int $httpStatusCode, $datas = null)
    {
        $returns = [
            "code"  => $httpStatusCode,
            "status"  => $this->httpStatusCode($httpStatusCode)
        ];

        if (!is_null($message)) :
            $returns["message"] = $message;
        endif;

        if (!is_null($datas)) :
            $returns["data"] = $datas;
        endif;

        return $returns;
    }

    /**
     * success response
     */
    // protected function success(string $message)
    // {
    //     return $this->sendResponse($message, false);
    // }

    // /**
    //  * success data response
    //  */
    // protected function successData(string $message, $data = null)
    // {
    //     return $this->sendResponse($message, false, $data);
    // }

    // /**
    //  * fail response
    //  */
    // protected function error(string $message)
    // {
    //     return $this->sendResponse($message, true);
    // }
}
