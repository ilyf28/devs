@extends('layout')

@section('content')
<h1>Token 유효성 확인</h1>
<h3>Message: {{ $message }}</h3>
<p>
    <label>Token 확인</label>
    <a href="{{ url('/v1/auth/authorize') }}"><button>확인</button></a>
</p>
<p>
    <form method="POST" action="{{ url('/v1/auth/tokens') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label>Token 생성</label>
        <br />
        <label>ID</label>
        <input type="text" name="id" value="demo" readonly="readonly" />&nbsp;&nbsp;&nbsp;
        <label>Password</label>
        <input type="password" name="password" value="secret" readonly="readonly" />&nbsp;&nbsp;&nbsp;
        <button type="submit">생성</button>
    </form>
</p>
@endsection