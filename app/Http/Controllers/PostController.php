<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    protected PostService $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->postService->create(auth()->user(), $data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     *
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();

        $this->postService->update($post, $data);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->postService->delete($post);

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully');
    }
}
