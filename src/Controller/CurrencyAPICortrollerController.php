<?php

namespace App\Controller;

use App\Services\FastForexCurrencyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyAPICortrollerController  extends AbstractRestController
{
    /**
     * @Route("/api/exchange", name="exchange")
     */
    public function index(Request $request, FastForexCurrencyService $currencyService): Response
    {
        $jsonData = $this->requestDecode($request);
        $rate = $currencyService->exchange($jsonData);
        return $this->successResponse($rate);
    }

    /**
     * @Route("/api/import", name="import")
     */
    public function import(Request $request, FastForexCurrencyService $currencyService): Response
    {
        $jsonData = $this->requestDecode($request);
        $rate = $currencyService->exchange($jsonData);
        $import = $currencyService->import($rate);

        return $this->successResponse();
    }
}
