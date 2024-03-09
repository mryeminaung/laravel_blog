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
            @if (session('comment'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('comment') }}
                </div>
            @endif
            <ul class="list-group">
                <li class="list-group-item active d-flex  justify-content-between align-items-center  ">
                    <b>Comments ({{ count($article->comments) }})</b>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#commentModal">
                        Add Comment
                    </button>
                </li>
                @foreach ($article->comments as $comment)
                    <li class="list-group-item d-flex flex-column align-items-start ">
                        {{ $comment->content }}
                        <a class="btn btn-danger btn-sm" href="{{ route('comments.delete', [$article, $comment]) }}">
                            Delete
                        </a>
                    </li>
                @endforeach
            </ul>
            <!-- Modal -->
            <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="commentModalLabel">Add Comment</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('comments.create', $article) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <textarea name="content" class="form-control mb-2" placeholder="New Comment" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Add Comment" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
