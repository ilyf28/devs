@extends('layout')

@section('content')
<h1>List Volumes</h1>
<h3>Message: {{ $message }}</h3>
<p>
    <form method="GET" action="{{ url('/volumes/create') }}">
        <button type="submit">Create Volume</button>
    </form>
</p>
<br />
<p>
    @foreach ($volumes as $volume)
        <form method="POST" action="{{ url('/volumes/'.$volume->id) }}">
            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
            <input type="hidden" name="_method" value="delete" />
            {{ $volume->id }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{ $volume->name }}&nbsp;&nbsp;&nbsp;
            <a href="{{ url('/volumes/'.$volume->id) }}">상세보기</a>&nbsp;&nbsp;&nbsp;
            <a href="{{ url('/volumes/'.$volume->id.'/edit') }}">수정</a>&nbsp;&nbsp;&nbsp;
            <button type="submit">삭제</button>
        </form>
    @endforeach
</p>
@endsection