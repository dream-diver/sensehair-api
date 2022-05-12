<?php

declare(strict_types=1);

namespace App\Util;

use Illuminate\Http\Response;

trait HandleResponse
{
    public function respondOk(array $payload = [])
    {
        return $this->respond($payload, Response::HTTP_OK);
    }

    public function respondBad(array $payload = [])
    {
        return $this->respond($payload, Response::HTTP_BAD_REQUEST);
    }

    public function respondUnauthorized(array $payload = [])
    {
        return $this->respond($payload, Response::HTTP_UNAUTHORIZED);
    }

    public function respondForbidden(array $payload = [])
    {
        return $this->respond($payload, Response::HTTP_FORBIDDEN);
    }

    public function respondNotFound(array $payload = [])
    {
        return $this->respond($payload, Response::HTTP_NOT_FOUND);
    }

    public function respondServerError(array $payload = [])
    {
        return $this->respond($payload, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function respondCreated(array $payload = [])
    {
        return $this->respond($payload, Response::HTTP_CREATED);
    }

    public function respondNoContent(array $payload = [])
    {
        return $this->respond($payload, Response::HTTP_NO_CONTENT);
    }

    private function respond($payload, $status)
    {
        return response()->json($payload, $status);
    }
}
