@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">📝 All Blog Posts</h1>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <form action="{{ route('posts.search') }}" method="GET" class="d-flex gap-2">
                <input type="text" 
                        name="search" 
                        class="form-control" 
                        placeholder="Search posts..." 
                        value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
                @if(request('search'))
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Clear</a>
                @endif
            </form>
        </div>
    </div>
    <!-- Search Results Info -->
    @if(request('search'))
        <div class="alert alert-info">
            Search results for: "{{ request('search') }}"
            ({{ $posts->total() }} {{ Str::plural('result', $posts->total()) }} found)
        </div>
    @endif

    @auth
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-4">➕ Create New Post</a>
    @endauth

    @if($posts->isEmpty())
        <div class="alert alert-info">
            No posts found. Be the first to create one!
        </div>
    @else
        @foreach ($posts as $post)
        <!-- post card code -->
            <div class="post-card mb-4">
                <h2 class="post-title">
                    <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none">
                        {{ $post->title }}
                    </a>
                </h2>
                <p>{{ Str::limit($post->description, 150, '...') }}</p>
                <div class="post-meta text-muted mb-2">
                    <small>
                        Posted by {{ $post->user->name ?? 'Unknown' }} 
                        on {{ $post->created_at->format('F j, Y, g:i a') }}
                    </small>
                </div>

                <a href="{{ route('posts.show', $post->id) }}" 
                    class="btn btn-outline-primary btn-sm">
                    View →
                </a>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection
