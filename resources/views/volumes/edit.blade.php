@extends('layout')

@section('content')
<h1>Edit Volume</h1>
<h3>Message: {{ $message }}</h3>
<p>
    <form method="POST" action="{{ url('/volumes/'.$volume_id) }}">
        <!-- <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" /> -->
        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="put" />
        <label>Name: </label><input type="text" name="name" value="{{ $name }}" /><br />
        <label>Description: </label><input type="text" name="description" value="{{ $description }}" /><br />
        <label>Size: </label><input type="text" name="size" value="{{ $size }}" /><br />
        <button type="submit">Volume 수정</button>
    </form>
</p>
<br />
<p>
    <a href="/volumes">List Volume</a>
</p>
@endsection