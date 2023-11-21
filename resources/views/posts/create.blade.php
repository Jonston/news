@extends('layouts.admin')

@section('content')
    @include('posts.form', [
        'post' => null,
        'action' => route('admin.posts.store'),
        'method' => 'POST',
    ])
@endsection

