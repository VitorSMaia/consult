<?php

namespace App\Service\API;

use App\Models\Artists;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class ViaCEP
{
    private $link = 'https://viacep.com.br/ws/';
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->link,
            'timeout'  => 2.0,
        ]);
    }

    public function fetchData($cep = null)
    {
        try {
            if(is_null($cep)) {
                return [
                    'erro' => 'Error'
                ];
            }

            $cep = str_replace('-', '', $cep);

            $cep = "$cep/json/";

            $response = $this->client->request('GET', $cep);

            if($response->getStatusCode() != 200) {
                return [
                    'erro' => 'Error'
                ];
            }

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $exception) {
            Log::error('[ViaCep][fetchData]::find => ' . $exception->getMessage());
            return [
                'erro' => 'Error'
            ];
        }
    }
}