<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'title'   => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', '게시글이 등록되었습니다.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, '권한이 없습니다.');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, '권한이 없습니다.');
        }

        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update([
            'title'   => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('success', '게시글이 수정되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, '권한이 없습니다.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', '게시글이 삭제되었습니다.');
    }
}
