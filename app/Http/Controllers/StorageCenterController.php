<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class StorageCenterController extends Controller
{
    protected $_client;

    public function __construct()
    {
        $this->_client = new Client(['verify' => false]);
    }

    public function scServer(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            try {
                $response = $this->_client->request('GET', env('DSM_REST_API_URI').'/StorageCenter/ScServer', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $result = json_decode($response->getBody());

                    return view('storageCenter', ['message' => 'Success.', 'scServers' => $result]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('storageCenter', ['message' => 'You need some cookie. Please login.']);
    }

    public function hbaList(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            $instance_id = $request->instance_id;
            try {
                $response = $this->_client->request('GET', env('DSM_REST_API_URI').'/StorageCenter/ScServer/'.$instance_id.'/HbaList', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $result = $response->getBody();

                    return view('storageCenter', ['message' => $result]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('storageCenter', ['message' => 'You need some cookie. Please login.']);
    }

    public function storageUsage(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            $instance_id = $request->instance_id;
            try {
                $response = $this->_client->request('GET', env('DSM_REST_API_URI').'/StorageCenter/ScServer/'.$instance_id.'/StorageUsage', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $result = $response->getBody();

                    return view('storageCenter', ['message' => $result]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('storageCenter', ['message' => 'You need some cookie. Please login.']);
    }

    public function scVolume(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            try {
                $response = $this->_client->request('GET', env('DSM_REST_API_URI').'/StorageCenter/ScVolume', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $result = json_decode($response->getBody());

                    return view('storageCenter', ['message' => 'Success.', 'scVolumes' => $result]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('storageCenter', ['message' => 'You need some cookie. Please login.']);
    }

    public function scVolumeStore(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            try {
                $response = $this->_client->request('POST', env('DSM_REST_API_URI').'/StorageCenter/ScVolume', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ],
                    'json' => [
                        'Name' => 'RestAPI_Test_Vol',
                        'Size' => '10GB',
                        'StorageCenter' => '75618'
                    ]
                ]);

                if ($response->getStatusCode() === 201) {
                    $result = $response->getBody();

                    return view('storageCenter', ['message' => $result]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('storageCenter', ['message' => 'You need some cookie. Please login.']);
    }

    public function scVolumeShow(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            $instance_id = $request->instance_id;
            try {
                $response = $this->_client->request('GET', env('DSM_REST_API_URI').'/StorageCenter/ScVolume/'.$instance_id, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $result = $response->getBody();

                    return view('storageCenter', ['message' => $result]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('storageCenter', ['message' => 'You need some cookie. Please login.']);
    }

    public function scVolumeDestroy(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            $instance_id = $request->instance_id;
            try {
                $response = $this->_client->request('DELETE', env('DSM_REST_API_URI').'/StorageCenter/ScVolume/'.$instance_id, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $result = $response->getBody();

                    return view('storageCenter', ['message' => $result]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('storageCenter', ['message' => 'You need some cookie. Please login.']);
    }

    public function expandToSize(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            $instance_id = $request->instance_id;
            try {
                $response = $this->_client->request('POST', env('DSM_REST_API_URI').'/StorageCenter/ScVolume/'.$instance_id.'/ExpandToSize', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ],
                    'json' => [
                        'NewSize' => '14GB'
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $result = $response->getBody();

                    return view('storageCenter', ['message' => $result]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('storageCenter', ['message' => 'You need some cookie. Please login.']);
    }

    public function mapToServer(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            $instance_id = $request->instance_id;
            try {
                $response = $this->_client->request('POST', env('DSM_REST_API_URI').'/StorageCenter/ScVolume/'.$instance_id.'/MapToServer', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ],
                    'json' => [
                        'Server' => '75618.25'
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $result = $response->getBody();

                    return view('storageCenter', ['message' => $result]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('storageCenter', ['message' => 'You need some cookie. Please login.']);
    }

    public function unmap(Request $request)
    {
        $Cookie = session('Cookie');

        if (!empty($Cookie) && !is_null($Cookie)) {
            $instance_id = $request->instance_id;
            try {
                $response = $this->_client->request('POST', env('DSM_REST_API_URI').'/StorageCenter/ScVolume/'.$instance_id.'/Unmap', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Cookie' => $Cookie,
                        'x-dell-api-version' => '3.3'
                    ]
                ]);

                if ($response->getStatusCode() === 202 || $response->getStatusCode() === 204) {
                    $result = $response->getBody();

                    return view('storageCenter', ['message' => $result]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('storageCenter', ['message' => 'You need some cookie. Please login.']);
    }
}
