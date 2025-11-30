<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
            'attachment' => 'nullable|file|max:20480', // 20MB 정도
        ]);

        $data = [
            'title'   => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ];

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $data['attachment_path'] = $path;
            $data['attachment_original_name'] = $request->file('attachment')->getClientOriginalName();
        }

        Post::create($data);

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
        // 작성자 체크
        if ($post->user_id !== auth()->id()) {
            abort(403, '권한이 없습니다.');
        }

        // 유효성 검사
        $request->validate([
            'title'      => 'required|max:255',
            'content'    => 'required',
            'attachment' => 'nullable|file|max:20480', // 20MB 예시
        ]);

        // 기본 업데이트 데이터
        $data = [
            'title'   => $request->title,
            'content' => $request->content,
        ];

        // 새 첨부파일이 올라온 경우
        if ($request->hasFile('attachment')) {

            // 기존 파일 삭제(선택 사항이지만 깔끔하게 처리)
            if ($post->attachment_path) {
                Storage::disk('public')->delete($post->attachment_path);
            }

            // 새 파일 저장
            $path = $request->file('attachment')->store('attachments', 'public');

            $data['attachment_path'] = $path;
            $data['attachment_original_name'] =
                $request->file('attachment')->getClientOriginalName();
        }

        // DB 업데이트
        $post->update($data);

        return redirect()
            ->route('posts.show', $post->id)
            ->with('success', '게시글이 수정되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
        abort(403, '권한이 없습니다.');
        }

        // 첨부파일 있으면 같이 삭제
        if ($post->attachment_path) {
            Storage::disk('public')->delete($post->attachment_path);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', '게시글이 삭제되었습니다.');
    }
}
