@extends('layout')

@section('content')
<h1>REST API</h1>
<h3><span style="display: block; width: 90%; word-wrap: break-word;">Message: {{ $message }}</span></h3>
<h4>ScServer</h4>
<p>
    <ul>
        <li>[GET] /StorageCenter/ScServer</li>
    </ul>
    <form method="GET" action="{{ url('/api/StorageCenter/ScServer') }}">
        <span>Gets a list of ScServer objects</span>
        <button type="submit">ScServer</button>
    </form>
    @isset($scServers)
        @foreach ($scServers as $scServer)
            <p>
                Name: {{ $scServer->name }}<br />
                <a href="{{ url('/api/StorageCenter/ScServer/'.$scServer->instanceId.'/HbaList') }}">HBA List</a><br />
                <a href="{{ url('/api/StorageCenter/ScServer/'.$scServer->instanceId.'/StorageUsage') }}">Storage Usage</a><br />
            </p>
            <br />
        @endforeach
    @endisset
</p>
<br />
<h4>ScVolume</h4>
<p>
    <ul>
        <li>[GET] /StorageCenter/ScVolume</li>
    </ul>
    <form method="GET" action="{{ url('/api/StorageCenter/ScVolume') }}">
        <span>Gets a list of ScVolume objects</span>
        <button type="submit">ScVolume</button>
    </form>
    @isset($scVolumes)
        @foreach ($scVolumes as $scVolume)
            <p>
                <form method="POST" action="{{ url('/api/StorageCenter/ScVolume/'.$scVolume->instanceId) }}">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="_method" value="delete" />
                    Name: {{ $scVolume->name }}&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/api/StorageCenter/ScVolume/'.$scVolume->instanceId) }}">상세보기</a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/api/StorageCenter/ScVolume/'.$scVolume->instanceId.'/ExpandToSize') }}">사이즈 변경</a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/api/StorageCenter/ScVolume/'.$scVolume->instanceId.'/MapToServer') }}">서버에 연결</a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/api/StorageCenter/ScVolume/'.$scVolume->instanceId.'/Unmap') }}">서버와 연결 끊기</a>&nbsp;&nbsp;&nbsp;
                    <button type="submit">volume 삭제</button>
                </form>
            </p>
        @endforeach
    @endisset
</p>
<br />
<p>
    <ul>
        <li>[POST] /StorageCenter/ScVolume</li>
    </ul>
    <form method="POST" action="{{ url('/api/StorageCenter/ScVolume') }}">
        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
        <span>Creates an Instance of a ScVolume object</span>
        <button type="submit">ScVolume</button>
    </form>
</p>
@endsection