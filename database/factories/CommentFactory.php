<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        $comments = [
            '좋은 글 잘 보고 갑니다 🙂',
            '댓글 기능 테스트 중입니다. 😎',
            '덕분에 라라벨 공부에 도움이 됩니다! ❤️',
            '댓글 수정/삭제 기능 테스트하고 싶다면 작성자가 테스트해주십시오 😉',
            '더미 데이터지만 작성자만 지울 수 있습니다. 😁',
        ];

        return [
            'content' => fake()->randomElement($comments),
        ];
    }
}
