<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class FastForexCurrencyService
{
    public function  exchange($json)
    {
        try{
            $response = $this->get($json->name);
            $jsonCurrency = json_decode($response->getBody()->getContents());
            $value = $json->value;
            return [
                "EUR" => $value * $jsonCurrency->results->EUR,
                "GBP" => $value * $jsonCurrency->results->GBP,
                "CHF" => $value * $jsonCurrency->results->CHF,
                "USD" => $value * $jsonCurrency->results->USD,
                "PLN" => $value * $jsonCurrency->results->PLN
            ];
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

    public function get($currency = 'PLN'): ?Response
    {
        $response = $this->createSimplyClient()->request('GET',
            $this->createUrl(),
            ['query' => [
                'from' => $currency,
                'to' => 'EUR,GBP,CHF,USD,PLN',
                'api_key' => $_ENV['FASTFOREX_API_KEY']
            ]]
        );
        return $response;
    }

    public function createSimplyClient(): ?Client
    {
        $client = new Client(['base_uri' => $this->createUrl()]);
        return $client;
    }

    public function createUrl(): ?string
    {
        //https://api.fastforex.io/fetch-multi?from=USD&to=EUR,GBP,CHF,USD,PLN&api_key=demo
        return 'https://' . $_ENV['FASTFOREX_URL'] . '/fetch-multi';
    }

    public function import($array): ?string
    {
        $fp = fopen('file.csv', 'w');
        foreach ($array as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
    }

}