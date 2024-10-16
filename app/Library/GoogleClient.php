<?php

namespace app\Library;

use Google\Client;
use Google\Service\Oauth2 as ServiceOauth2;
use Google\Service\Oauth2\Userinfo;
use GuzzleHttp\Client as GuzzleClient;
use Mockery\Exception;

class GoogleClient
{
    public readonly Client $client;
    private Userinfo $data;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function init()
    {
        $guzzleClient = new GuzzleClient(['curl' => [CURLOPT_SSL_VERIFYPEER => false]]);
        $this->client->setHttpClient($guzzleClient);
        $this->client->setClientId(env('GOOGLE_ID_CLIENT'));
        $this->client->setClientSecret(env('GOOGLE_SECRET_CLIENT'));
        $this->client->setRedirectUri('http://localhost:8000/login');
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function authenticated()
    {
        try {
            if (isset($_GET['code'])) {
                $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
                $this->client->setAccessToken($token['access_token']);
                $googleService = new ServiceOauth2($this->client);
                $this->data = $googleService->userinfo->get();

                return true;
            }

            return false;
        }catch (Exception $exception){
            dd($exception);
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function generateAuthLink()
    {
        return $this->client->createAuthUrl();
    }
}