<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;

class ApiException extends HttpResponseException
{
    public function __construct(int $code = 422, string $message = 'Validation error', $errors = [])
    {
        $data = [
            'error' => [
                'code' => $code,
                'message' => $message,
            ],
        ];

        if (count($errors) > 0) {
            $data['error']['errors'] = $errors;
        }

        parent::__construct(
            response()
                ->json($data)
                ->setStatusCode($code, $message)
        );
    }
}
