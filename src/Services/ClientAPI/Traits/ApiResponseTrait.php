<?php

namespace App\Services\ClientAPI\Traits;

use App\Services\ClientAPI\ResponseCreator;
use Exception;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTrait
{
    /**
     * @var ResponseCreator
     */
    private $responseCreator;

    /**
     * @required
     */
    public function setResponseCreator(ResponseCreator $responseCreator)
    {
        $this->responseCreator = $responseCreator;
    }

    protected function successResponse($data = ResponseCreator::RESPONSE_SUCCESS, int $code = Response::HTTP_OK): JsonResponse
    {
        return $this->responseCreator->createSuccess($data, $code);
    }

    protected function exceptionResponse(Exception $exception): JsonResponse
    {
        return $this->responseCreator->fromException($exception);
    }

    protected function errorResponse($data = ['content' => 'error'], int $code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return $this->responseCreator->createError(['content' =>$data], $code);
    }

}