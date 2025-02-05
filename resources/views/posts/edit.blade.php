@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $post->description) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
