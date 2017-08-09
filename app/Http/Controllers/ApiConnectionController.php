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
            $response = $this->_client->request('POST', env('DSM_REST_API_URI').'/ApiConnection/Login', [
                'headers' => [
                    'Authorization' => 'Basic ZGVsbDpkZWxs',
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
                    $response_body = $response->getBody();
                    return view('api', ['message' => 'Success. '.$response_body]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('api', ['message' => 'Cookie 값이 없습니다. Login 해주세요.']);
    }
}
