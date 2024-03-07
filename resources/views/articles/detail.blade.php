@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}
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
    </div>
@endsection
