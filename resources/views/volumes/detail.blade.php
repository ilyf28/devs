@extends('layout')

@section('content')
<h1>Detail Volume</h1>
<h3>Message: {{ $message }}</h3>
<p>
    @php
        //dd($volume);
    @endphp

    <label>status</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->status }}<br />
    <label>user_id</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->user_id }}<br />
    <label>availability_zone</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->availability_zone }}<br />
    <label>bootable</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->bootable }}<br />
    <label>encrypted</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->encrypted }}<br />
    <label>created_at</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->created_at }}<br />
    <label>updated_at</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->updated_at }}<br />
    <label>volume_type</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->volume_type }}<br />
    <label>name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->name }}<br />
    <label>description</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->description }}<br />
    <label>replication_status</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->replication_status }}<br />
    <label>consistencygroup_id</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->consistencygroup_id }}<br />
    <label>source_volid</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->source_volid }}<br />
    <label>snapshot_id</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->snapshot_id }}<br />
    <label>multiattach</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->multiattach }}<br />
    <label>id</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->id }}<br />
    <label>size</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->size }}<br />

    <!-- @foreach ($volume as $key => $value)
        {{ $key }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $volume->user_id }}<br />
    @endforeach -->
</p>
<br />
<p>
    <a href="/volumes">List Volume</a>
</p>
@endsection