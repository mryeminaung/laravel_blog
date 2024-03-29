@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{ $articles->links() }}

        @foreach ($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex gap-2 ">
                        <h5 class="card-title">
                            {{ $article->title }}
                        </h5>
                        <p class="badge h-25 text-bg-secondary">
                            {{ $article->category['name'] }}
                        </p>
                    </div>
                    <div class="card-subtitle mb-2 text-muted small">
                        {{ $article->updated_at->diffForHumans() }}
                    </div>
                    <p class="card-text">{{ $article->body }}</p>
                    <a class="card-link btn btn-primary" href="{{ url("/articles/detail/$article->slug") }}">
                        View Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
