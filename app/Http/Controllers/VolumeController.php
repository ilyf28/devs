<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class VolumeController extends Controller
{
    protected $_client;

    public function __construct()
    {
        $this->_client = new Client();
    }

    public function listVolumes(Request $request)
    {
        $x_subject_token = session('x_subject_token');

        if (!empty($x_subject_token) && !is_null($x_subject_token)) {
            try {
                $response = $this->_client->request('GET', env('DEVSTACK_URL_VOLUME').'/v3/'.env('DEVSTACK_PROJECT_ID_DEMO').'/volumes', [
                    'headers' => [
                        'X-Auth-Token' => $x_subject_token
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $response_body = json_decode($response->getBody());
                    $volumes = $response_body->volumes;
                    return view('volumes.list', ['message' => 'Success.', 'volumes' => $volumes]);
                } else {
                    // return view('token', ['message' => 'Fail. Error response code: '.$response->getStatusCode()]);
                }
            } catch (Exception $e) {
                // return view('token', ['message' => 'Exception: '.$e]);
            }
        }

        return view('token', ['message' => 'Token이 없습니다. "Token 생성" 항목의 "생성" 버튼을 클릭하세요.']);
    }

    public function showVolumeDetails(Request $request)
    {
        $x_subject_token = session('x_subject_token');

        if (!empty($x_subject_token) && !is_null($x_subject_token)) {
            $volume_id = $request->volume_id;
            try {
                $response = $this->_client->request('GET', env('DEVSTACK_URL_VOLUME').'/v3/'.env('DEVSTACK_PROJECT_ID_DEMO').'/volumes/'.$volume_id, [
                    'headers' => [
                        'X-Auth-Token' => $x_subject_token
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $response_body = json_decode($response->getBody());
                    $volume = $response_body->volume;
                    return view('volumes.detail', ['message' => 'Success.', 'volume' => $volume]);
                } else {
                    // return view('token', ['message' => 'Fail. Error response code: '.$response->getStatusCode()]);
                }
            } catch (Exception $e) {
                // return view('token', ['message' => 'Exception: '.$e]);
            }
        }

        return view('token', ['message' => 'Token이 없습니다. "Token 생성" 항목의 "생성" 버튼을 클릭하세요.']);
    }

    public function createVolume(Request $request)
    {
        return view('volumes.create', ['message' => 'Success.']);
    }

    public function storeVolume(Request $request)
    {
        $x_subject_token = session('x_subject_token');

        if (!empty($x_subject_token) && !is_null($x_subject_token)) {
            $name = $request->name;
            $description = $request->description;
            $size = $request->size;
            $payload = array(
                "volume" => array(
                    "name" => $name,
                    "description" => $description,
                    "size" => $size,
                    "source_volid" => null,
                    "multiattach" => false,
                    "snapshot_id" => null,
                    "imageRef" => null,
                    "volume_type" => "lvmdriver-1",
                    "metadata" => array(),
                    "source_replica" => null,
                    "consistencygroup_id" => null,
                    "availability_zone" => null
                )
            );

            try {
                $response = $this->_client->request('POST', env('DEVSTACK_URL_VOLUME').'/v3/'.env('DEVSTACK_PROJECT_ID_DEMO').'/volumes', [
                    'headers' => [
                        'X-Auth-Token' => $x_subject_token
                    ],
                    'json' => $payload
                ]);

                if ($response->getStatusCode() === 202) {
                    $response_body = json_decode($response->getBody());
                    $volume = $response_body->volume;
                    return view('volumes.detail', ['message' => 'Success.', 'volume' => $volume]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('token', ['message' => 'Token이 없습니다. "Token 생성" 항목의 "생성" 버튼을 클릭하세요.']);
    }

    public function editVolume(Request $request)
    {
        $x_subject_token = session('x_subject_token');

        if (!empty($x_subject_token) && !is_null($x_subject_token)) {
            $volume_id = $request->volume_id;
            try {
                $response = $this->_client->request('GET', env('DEVSTACK_URL_VOLUME').'/v3/'.env('DEVSTACK_PROJECT_ID_DEMO').'/volumes/'.$volume_id, [
                    'headers' => [
                        'X-Auth-Token' => $x_subject_token
                    ]
                ]);

                if ($response->getStatusCode() === 200) {
                    $response_body = json_decode($response->getBody());
                    $volume = $response_body->volume;
                    return view('volumes.edit', ['message' => 'Success.', 'volume_id' => $volume_id, 'name' => $volume->name, 'description' => $volume->description, 'size' => $volume->size]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('token', ['message' => 'Token이 없습니다. "Token 생성" 항목의 "생성" 버튼을 클릭하세요.']);
    }

    public function updateVolume(Request $request)
    {
        $x_subject_token = session('x_subject_token');

        if (!empty($x_subject_token) && !is_null($x_subject_token)) {
            $volume_id = $request->volume_id;
            $name = $request->name;
            $description = $request->description;
            $size = $request->size;
            $payload = array(
                "volume" => array(
                    "name" => $name,
                    "description" => $description,
                    "size" => $size
                )
            );

            try {
                $response = $this->_client->request('PUT', env('DEVSTACK_URL_VOLUME').'/v3/'.env('DEVSTACK_PROJECT_ID_DEMO').'/volumes/'.$volume_id, [
                    'headers' => [
                        'X-Auth-Token' => $x_subject_token
                    ],
                    'json' => $payload
                ]);

                if ($response->getStatusCode() === 200) {
                    $response_body = json_decode($response->getBody());
                    $volume = $response_body->volume;
                    return view('volumes.detail', ['message' => 'Success.', 'volume' => $volume]);
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('token', ['message' => 'Token이 없습니다. "Token 생성" 항목의 "생성" 버튼을 클릭하세요.']);
    }

    public function destroyVolume(Request $request)
    {
        $x_subject_token = session('x_subject_token');

        if (!empty($x_subject_token) && !is_null($x_subject_token)) {
            $volume_id = $request->volume_id;

            try {
                $response = $this->_client->request('DELETE', env('DEVSTACK_URL_VOLUME').'/v3/'.env('DEVSTACK_PROJECT_ID_DEMO').'/volumes/'.$volume_id, [
                    'headers' => [
                        'X-Auth-Token' => $x_subject_token
                    ]
                ]);

                if ($response->getStatusCode() === 202) {
                    sleep(2);
                    return redirect('/volumes');
                } else {
                }
            } catch (Exception $e) {
            }
        }

        return view('token', ['message' => 'Token이 없습니다. "Token 생성" 항목의 "생성" 버튼을 클릭하세요.']);
    }
}
