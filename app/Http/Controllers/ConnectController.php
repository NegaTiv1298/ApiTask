<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException as GuzzleExceptionAlias;

class ConnectController extends Controller
{
    /** @var string */
    private const API_URL = 'https://f36a998b16cbc39ac759d4084930865e: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@the-beginning-of-the-best.myshopify.com/admin/api/2021-07/products.json';


    /**
     * External api connection
     *
     * @return array
     * @throws GuzzleExceptionAlias
     */
    public static function apiConnectAction(): array
    {
        $client = new Client();
        $headers = [
            'Content-type' => 'application/json',
        ];
        $response = $client->request('GET', self::API_URL, [
            'headers' => $headers
        ]);

        $result = json_decode($response->getBody()->getContents(), true)['products'];


        return $result;
    }
}
