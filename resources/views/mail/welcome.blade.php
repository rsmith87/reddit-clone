@extends('mail.layouts.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Welcome to {{ config('app.name') }}</h2>
<p>WHOA NELLY</p>
@{{{body}}}
@endsection