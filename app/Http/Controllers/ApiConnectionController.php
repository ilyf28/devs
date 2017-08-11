<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class ApiConnectionController extends Controller
{
    protected $_client;

    public function __construct()
    {
        $this->_client = new Client(['verify' => false]);
    }

    public function login(Request $request)
    {
        try {
            $auth = base64_encode('dell:dell');
            $response = $this->_client->request('POST', env('DSM_REST_API_URI').'/ApiConnection/Login', [
                'headers' => [
                    'Authorization' => 'Basic '.$auth,
                    'Content-Type' => 'application/json',
                    'x-dell-api-version' => '3.3'
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $setCookie = $response->getHeader('Set-Cookie');
                session(['Cookie' => $setCookie[0]]);

                $response_body = $response->getBody();
                return view('api', ['message' => 'Success. '.$response_body]);
            } else {
            }
        } catch (Exception $e) {
        }

        return view('api', ['message' => 'Login fail']);
    }

    public function logout(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            try {
                $response = $this->_client->request('POST', env('DSM_REST_API_URI').'/ApiConnection/Logout', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ]
                ]);

                if ($response->getStatusCode() === 204) {
                    session(['Cookie' => null]);

                    return view('api', ['message' => 'Success.']);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        session(['Cookie' => null]);
        return view('api', ['message' => 'Logout Success.']);
    }

    public function apiConnection(Request $request)
    {
        $result = $this->_apiConnection();
        if (!is_null($result)) {
            return view('api', ['message' => $result]);
        }

        return view('api', ['message' => 'API Connection Fail.']);
    }

    public function storageCenterList(Request $request)
    {
        $result = $this->_apiConnection();
        if (!is_null($result)) {
            $resultObj = json_decode($result);
            $instanceId = $resultObj->instanceId;
            $Cookie = session('Cookie');

            if (!empty($Cookie) && !is_null($Cookie)) {
                try {
                    $response = $this->_client->request('GET', env('DSM_REST_API_URI').'/ApiConnection/ApiConnection/'.$instanceId.'/StorageCenterList', [
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Cookie' => $Cookie,
                            'x-dell-api-version' => '3.3'
                        ]
                    ]);

                    if ($response->getStatusCode() === 200) {
                        $storageCenters = json_decode($response->getBody());
                        return view('api', ['message' => 'Success.', 'storageCenters' => $storageCenters]);
                    } else {
                    }
                } catch (Exception $e) {
                }
            }

            return view('api', ['message' => 'Get StorageCenterList Fail.']);
        }

        return view('api', ['message' => 'API Connection Fail.']);
    }

    private function _apiConnection()
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            try {
                $response = $this->_client->request('GET', env('DSM_REST_API_URI').'/ApiConnection/ApiConnection', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    return $response->getBody();
                } else {
                    return null;
                }
            } catch (Exception $e) {
            }
        }
    }
}
