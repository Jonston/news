@extends('layouts.admin')

@section('content')
    @include('posts.form', [
        'post' => $post,
        'action' => route('admin.posts.update', $post->id),
        'method' => 'PUT',
    ]);
@endsection
