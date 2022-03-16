<?php

namespace App\Services\ClientAPI;

use App\Service\Exception\Exception;
use App\Service\Exception\ExceptionTransformer;
use JMS\Serializer\ArrayTransformerInterface;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder as SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\SerializerInterface;

class ResponseCreator
{
    const RESPONSE_ERROR = 'Request error';
    const RESPONSE_SUCCESS = 'Success';

    /** @var mixed */
    private $data;

    /** @var Error[] */
    private $errors;

    /** @var ArrayTransformerInterface  * */
    private $arrayTransformer;

    /** @var SerializerInterface $serializer * */
    private $serializer;

    /** @var FormErrorsTransformer * */
    private $formErrorsTransformer;

    /** @var ExceptionTransformer * */
    private $exceptionTransformer;

//    public function __construct(
//        FormErrorsTransformer $formErrorsTransformer,
//        ExceptionTransformer $exceptionTransformer
//    )
//    {
//        $this->formErrorsTransformer = $formErrorsTransformer;
//        $this->exceptionTransformer = $exceptionTransformer;
//    }

    public function data()
    {
        return $this->data;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function serializerCreate(): Serializer
    {
        //todo serializer
        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->build();

        return $serializer;
    }

    public function setSerializerContext(): SerializationContext
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);

        return $context;
    }

    public function createSuccess($data = null, int $code = Response::HTTP_OK): JsonResponse
    {
        $body = [
            'status'=> $code,
            "data" => $data
        ];
        return new JsonResponse(json_decode($this->serializerCreate()->serialize($body, 'json', $this->setSerializerContext())), $code);
    }

    public function createError($errors, int $code = Response::HTTP_OK): JsonResponse
    {
        $data = [
            'data' => [],
            'type' => 'request_error',
            'title' => self::RESPONSE_ERROR,
            'errors' => $errors
        ];
        return new JsonResponse($data, Response::HTTP_BAD_REQUEST);

    }

    public function fromException(Exception $exception): JsonResponse
    {
        $body = $this->exceptionTransformer->transform($exception);

        $code = $exception->getCode();
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
        }

        return new JsonResponse($this->arrayTransformer->toArray($body), $code ?: Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function toArray($data, ?SerializationContext $context = null, ?string $type = null): array
    {

    }

    public function fromArray(array $data, string $type, ?DeserializationContext $context = null)
    {

    }
}
