
@extends('mail.layouts.layout')

@section('content')
	@{{{body}}}
    <div class="post">
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
        <p>Author: {{ $post->user->name }}</p>
        <p>Created at: {{ $post->created_at }}</p>
    </div>
@endsection
