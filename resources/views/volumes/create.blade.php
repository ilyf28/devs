@extends('layout')

@section('content')
<h1>Create Volume</h1>
<h3>Message: {{ $message }}</h3>
<p>
    <form method="POST" action="{{ url('/volumes') }}">
        <!-- <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" /> -->
        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
        <label>Name: </label><input type="text" name="name" /><br />
        <label>Description: </label><input type="text" name="description" /><br />
        <label>Size: </label><input type="text" name="size" /><br />
        <button type="submit">Volume 생성</button>
    </form>
</p>
<br />
<p>
    <a href="/volumes">List Volume</a>
</p>
@endsection