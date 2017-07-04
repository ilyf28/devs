<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class AuthController extends Controller
{
    protected $_client;

    public function __construct()
    {
        $this->_client = new Client();
    }

    public function checkAuthorizedToken(Request $request)
    {
        $x_subject_token = session('x_subject_token');

        if (!empty($x_subject_token) && !is_null($x_subject_token)) {
            try {
                $response = $this->_client->request('GET', env('DEVSTACK_URL').'/v3/auth/tokens', [
                    'headers' => [
                        'X-Auth-Token' => $x_subject_token,
                        'X-Subject-Token' => $x_subject_token
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    return view('token', ['message' => 'Token이 유효합니다.']);
                } else {
                    return view('token', ['message' => 'Token 확인 중 문제가 발생하였습니다. Error response code: '.$response->getStatusCode()]);
                }
            } catch (Exception $e) {
                return view('token', ['message' => 'Exception: '.$e]);
            }
        }

        return view('token', ['message' => 'Token이 없습니다. "Token 생성" 항목의 "생성" 버튼을 클릭하세요.']);
    }

    public function getAuthorizedToken(Request $request)
    {
        // if ($request->session()->has('x_subject_token')) {
        //     return  $request->session()->get('x_subject_token');
        // }

        return null;
    }

    public function createAuthorizedToken(Request $request)
    {
        // $payload = [
        //     'auth' => [
        //         'identity' => [
        //             'methods' => ['password'],
        //             'password' => [
        //                 'user' => [
        //                     'name' => 'admin',
        //                     'domain' => [
        //                         'name' => 'Default'
        //                     ],
        //                     'password' => 'secret'
        //                 ]
        //             ]
        //         ]
        //     ]
        // ];

        $payload = [
            'auth' => [
                'identity' => [
                    'methods' => ['password'],
                    'password' => [
                        'user' => [
                            'id' => env('DEVSTACK_USER_ID_DEMO'),
                            'password' => env('DEVSTACK_USER_PW_DEMO')
                        ]
                    ]
                ],
                'scope' => [
                    'project' => [
                        'id' => env('DEVSTACK_PROJECT_ID_DEMO')
                    ]
                ]
            ]
        ];

        $response = $this->_client->request('POST', env('DEVSTACK_URL').'/v3/auth/tokens', ['json' => $payload]);
        $x_subject_token_obj = $response->getHeader('X-Subject-Token');
        $x_subject_token = $x_subject_token_obj[0];

        session(['x_subject_token' => $x_subject_token]);

        return view('token', ['message' => 'Token이 생성되었습니다. '.$x_subject_token]);
    }
}
