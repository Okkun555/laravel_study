<?php

namespace  App\Http\Responder;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TokenResponder
{
    public function __invoke($token, int $ttl): JsonResponse
    {
        if (!$token) {
            return new JsonResponse([
                'error' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_id' => $ttl,
        ], Response::HTTP_OK);
    }
}
