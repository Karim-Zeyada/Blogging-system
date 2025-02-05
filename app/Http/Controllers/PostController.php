<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Apply middleware to restrict access.
     */
    public function __construct()
    {
        // Allow index and show for guests; other methods require authentication.
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a paginated listing of posts.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title'       => 'required|min:3|unique:posts,title',
            'description' => 'required|min:10',
        ]);

        // Attach the authenticated user's ID
        $validated['user_id'] = Auth::id();

        // Create the post
        Post::create($validated);

        return redirect()->route('posts.index')
                            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        try {
            return view('posts.show', compact('post'));
        } catch (\Exception $e) {
            return redirect()->route('posts.index')
                            ->with('error', 'Post not found.');
        }
    }

    /**
     * Search for posts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $search = $request->get('search', '');

        if (empty($search)) {
            return redirect()->route('posts.index');
        }

        $posts = Post::query()
            ->with(['user', 'comments']) // Eager load relationships
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->latest()
            ->paginate(10);

        // Keep the search term for the view
        $posts->appends(['search' => $search]);

        return view('posts.index', [
            'posts' => $posts,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        // Ensure the current user owns the post.
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')
                                ->with('error', 'Unauthorized access.');
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Check ownership
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')
                                ->with('error', 'Unauthorized access.');
        }

        // Validate the request. Exclude the current post ID for the unique title check.
        $validated = $request->validate([
            'title'       => 'required|min:3|unique:posts,title,' . $post->id,
            'description' => 'required|min:10',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')
                            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        // Check ownership
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')
                                ->with('error', 'Unauthorized access.');
        }
        $post->delete();
        return redirect()->route('posts.index')
                            ->with('success', 'Post deleted successfully.');
    }
}
