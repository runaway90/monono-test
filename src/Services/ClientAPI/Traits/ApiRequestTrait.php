<?php

namespace App\Services\ClientAPI\Traits;

use Symfony\Component\HttpFoundation\Request;

trait ApiRequestTrait
{
    public function requestDecode(Request $request)
    {
        return json_decode($request->getContent());
    }

    public function checkAPIConnect(Request $request): bool
    {
        //to do
        if ($request->headers->get('api_connection') == 'active') {
                return true;
        }

        return true;
    }

}