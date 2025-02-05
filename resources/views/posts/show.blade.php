@extends('layouts.app')

<head>
    <!-- SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@section('content')
<div class="container mt-5">
    @if(isset($post))
        <div class="post-card">
            <h1 class="post-title mb-3">{{ $post->title }}</h1>
            
            <div class="post-meta text-muted mb-4">
                <span>Posted by {{ $post->user->name ?? 'Unknown' }}</span>
                <span class="mx-2">•</span>
                <span>{{ $post->created_at->format('F j, Y, g:i a') }}</span>
            </div>

            <div class="post-content mb-4">
                {{ $post->description }}

            </div>
            <div class="post-actions d-flex gap-2 align-items-center mt-4">
                <a href="{{ route('posts.index') }}" 
                    class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Posts
                </a>

                @auth
                    <form action="{{ route('posts.like', $post) }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" 
                                class="btn {{ $post->isLikedByUser(Auth::user()) ? 'btn-danger' : 'btn-outline-danger' }}">
                            <i class="bi bi-heart-fill"></i> 
                            <span>{{ $post->likes()->count() }} {{ Str::plural('Like', $post->likes()->count()) }}</span>
                        </button>
                    </form>

                    @if(Auth::id() === $post->user_id)
                        <div class="d-flex gap-2">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            
                            <button type="button" class="btn btn-danger" onclick="confirmDeletePost('{{ $post->id }}')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        @auth
            @if(Auth::id() === $post->user_id)
                <div class="modal fade" id="deleteConfirmModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this post? This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    @else
        <div class="alert alert-danger">
            Post not found. It may have been deleted or moved.
        </div>
        <a href="{{ route('posts.index') }}" class="btn btn-primary">
            Return to Posts List
        </a>
    @endif
</div>

    <!-- Comments Section -->
    <div class="comments-section mt-5">
        <h3 class="mb-4">Comments ({{ $post->comments->count() }})</h3>

        @auth
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('comments.store', $post) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="content" class="form-label">Add a comment</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                    name="content" 
                                    rows="3" 
                                    required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                Please <a href="{{ route('login') }}">login</a> to leave a comment.
            </div>
        @endauth

        <div class="comments-list">
            @forelse($post->comments as $comment)
                <div class="comment-card mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $comment->user->name }}</h6>
                                    <small class="text-muted">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                @if(Auth::id() === $comment->user_id || Auth::id() === $post->user_id)
                                    <form id="delete-comment-{{ $comment->id }}" action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger d-flex align-items-center gap-1 px-2 py-1"
                                            onclick="confirmDelete('{{ $comment->id }}')"
                                            style="border-radius: 50%; transition: all 0.3s ease;">
                                            <i class="bi bi-trash"></i> 
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <p class="mt-2 mb-0">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    No comments yet. Be the first to comment!
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function confirmDelete(commentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-comment-' + commentId).submit();
            }
        })
    }

    function confirmDeletePost(postId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form dynamically and submit it
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/posts/' + postId; // Adjust the action URL as needed

                var csrfField = document.createElement('input');
                csrfField.type = 'hidden';
                csrfField.name = '_token';
                csrfField.value = '{{ csrf_token() }}'; // Ensure you have the CSRF token

                var methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfField);
                form.appendChild(methodField);

                document.body.appendChild(form);
                form.submit();
            }
        })
    }
</script>

<!-- Custom styling :)  -->

<style>
    .post-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .post-content {
        line-height: 1.6;
        font-size: 1.1rem;
    }
    
    .post-meta {
        font-size: 0.9rem;
    }

    .comment-card {
        transition: transform 0.2s ease;
    }

    .comment-card:hover {
        transform: translateX(5px);
    }

    .comments-section {
        border-top: 1px solid #dee2e6;
        padding-top: 2rem;
    }

    .post-actions {
    border-top: 1px solid #dee2e6;
    padding-top: 1rem;
}

    .post-actions .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
    }

    .post-actions form {
        margin-bottom: 0;
    }

    /* Dark mode compatibility */
    .dark-mode .post-actions {
        border-top-color: #4b5563;
    }

    /* Hover effects */
    .post-actions .btn:hover {
        transform: translateY(-1px);
        transition: transform 0.2s ease;
    }

    .btn-danger:hover {
    background-color: #e3342f;  /* Darker red shade on hover */
    transform: scale(1.1);  /* Slight scaling effect */
    }
</style>
@endsection