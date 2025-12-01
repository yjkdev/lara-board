<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'content' => $request->content,
            'post_id' => $post->id,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', '댓글이 등록되었습니다.');
    }

    public function edit(Comment $comment)
    {
        // 작성자만 수정
        if (auth()->id() !== $comment->user_id) abort(403);

        return view('comments.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(Request $request, Comment $comment)
    {
        // 작성자만
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:1000'],
        ]);

        $comment->update([
            'content' => $validated['content'],
        ]);

        // 댓글이 속한 게시글 상세로 돌아가기
        return redirect()
            ->route('posts.show', $comment->post_id)
            ->with('success', '댓글이 수정되었습니다.');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', '댓글이 삭제되었습니다.');
    }
}
