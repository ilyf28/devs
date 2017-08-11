<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('token', ['message' => '"Token 확인" 항목의 "확인" 버튼을 클릭하세요.']);
});

Route::get('/token', function () {
    return view('token', ['message' => '"Token 확인" 항목의 "확인" 버튼을 클릭하세요.']);
});

Route::get('/volumes', 'VolumeController@listVolumes');
Route::get('/volumes/create', 'VolumeController@createVolume');
Route::post('/volumes', 'VolumeController@storeVolume');
Route::get('/volumes/{volume_id}', 'VolumeController@showVolumeDetails');
Route::get('/volumes/{volume_id}/edit', 'VolumeController@editVolume');
Route::put('/volumes/{volume_id}', 'VolumeController@updateVolume');
Route::delete('/volumes/{volume_id}', 'VolumeController@destroyVolume');

Route::get('/v1/auth/authorize', 'AuthController@checkAuthorizedToken');
// Route::get('/v1/auth/tokens', 'AuthController@getAuthorizedToken');
Route::post('/v1/auth/tokens', 'AuthController@createAuthorizedToken');



Route::get('/api', function () {
    return view('api', ['message' => 'API']);
});

Route::get('/storageCenter', function () {
    return view('storageCenter', ['message' => 'Storage Center']);
});

Route::prefix('api')->group(function () {
    // API Connection
    Route::post('/ApiConnection/Login', 'ApiConnectionController@login');
    Route::post('/ApiConnection/Logout', 'ApiConnectionController@logout');
    Route::get('/ApiConnection/ApiConnection', 'ApiConnectionController@apiConnection');
    Route::get('/ApiConnection/ApiConnection/StorageCenterList', 'ApiConnectionController@storageCenterList');

    // Storage Center
    Route::get('/StorageCenter/ScServer', 'StorageCenterController@scServer');
    Route::get('/StorageCenter/ScServer/{instance_id}/HbaList', 'StorageCenterController@hbaList');
    Route::get('/StorageCenter/ScServer/{instance_id}/StorageUsage', 'StorageCenterController@storageUsage');
    Route::get('/StorageCenter/ScVolume', 'StorageCenterController@scVolume');
    Route::post('/StorageCenter/ScVolume', 'StorageCenterController@scVolumeStore');
    Route::get('/StorageCenter/ScVolume/{instance_id}', 'StorageCenterController@scVolumeShow');
    Route::delete('/StorageCenter/ScVolume/{instance_id}', 'StorageCenterController@scVolumeDestroy');
    Route::get('/StorageCenter/ScVolume/{instance_id}/ExpandToSize', 'StorageCenterController@expandToSize');
    Route::get('/StorageCenter/ScVolume/{instance_id}/MapToServer', 'StorageCenterController@mapToServer');
    Route::get('/StorageCenter/ScVolume/{instance_id}/Unmap', 'StorageCenterController@unmap');
});
