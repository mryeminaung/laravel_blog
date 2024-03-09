@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-warning">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif

        <form method="post" action="{{ route('articles.update', $article) }}">
            @csrf
            @method('put')
            @method('patch')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" value="{{ $article->title }}" name="title" class="form-control">
            </div>
            <div class="mb-3">
                <label>Body</label>
                <textarea name="body" rows="4" class="form-control">{{ $article->body }}</textarea>
            </div>
            <div class="mb-3">
                <label>Category</label>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        <option {{ $category['id'] == $article->category_id ? 'selected' : '' }}
                            value="{{ $category['id'] }}">
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <a href="/articles/detail/{{ $article->slug }}" class="btn btn-secondary">
                Cancel
            </a>
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
@endsection
