@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a class="btn btn-primary mb-3" href="{{ url(session('pre_url') ?? '/articles') }}" role="button">Back to home</a>

        <div class="card mb-2">
            <div class="card-body">
                <div class="d-flex gap-2">
                    <h5 class="card-title">
                        {{ $article->title }}
                    </h5>
                    <p class="badge text-bg-secondary">
                        {{ $article->category->name }}
                    </p>
                </div>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->updated_at->diffForHumans() }}
                </div>
                <p class="card-text">{{ $article->body }}</p>

                <a class="btn btn-warning" href="{{ route('articles.edit', $article) }}">
                    Edit
                </a>
                <a class="btn btn-danger" href="{{ url("/articles/delete/$article->id") }}">
                    Delete
                </a>
            </div>
        </div>
        <div class="my-2">
            <ul class="list-group">
                <li class="list-group-item active">
                    <b>Comments ({{ count($article->comments) }})</b>
                </li>
                @foreach ($article->comments as $comment)
                    <li class="list-group-item">
                        {{ $comment->content }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
