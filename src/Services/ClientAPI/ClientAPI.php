<?php

namespace App\Services\ClientAPI;

use App\Services\ClientAPI\Traits\ApiRequestTrait;
use App\Services\ClientAPI\Traits\ApiResponseTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientAPI extends AbstractController
{
    use ApiRequestTrait;
    use ApiResponseTrait;
}