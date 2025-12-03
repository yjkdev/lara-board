<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $titles = [
            '테스트 게시글입니다 😎',
            'Laravel 게시판 더미 데이터 😉',
            '샘플 게시글 😘',
            '연습용 게시글입니다 🤣',
        ];

        $contents = [
            "이 글은 개발 환경에서 테스트를 위해 자동으로 생성된 더미 데이터입니다.\n자유롭게 수정하고 삭제해도 괜찮습니다만 작성자만 가능합니다.",
            "라라벨 게시판 기능을 확인하기 위한 샘플 글입니다.\n작성자로 로그인해서 댓글 작성, 수정, 삭제 기능을 테스트해 보세요.",
            "테스트용 내용입니다. 여러 줄의 텍스트가 들어가도록 작성했습니다.\n줄바꿈도 정상적으로 보이는지 확인해 보세요.",
            "이 글은 실제 내용이 없는 연습용 게시글입니다.\n작성자로 로그인해서 목록, 상세 페이지, 첨부파일 기능을 확인해 보세요.",
        ];

        $imagePaths = [
            'attachments/sample1.jpg',
            'attachments/sample2.jpg',
            'attachments/sample3.jpg',
            'attachments/sample4.jpg',
            'attachments/sample5.jpg',
        ];

        $hasAttachment = true;

        $attachmentPath = null;
        $attachmentOriginalName = null;

        if ($hasAttachment) {
            $attachmentPath = fake()->randomElement($imagePaths);
            $attachmentOriginalName = basename($attachmentPath);
        }

        return [
            'title'   => fake()->randomElement($titles),
            'content' => fake()->randomElement($contents),
            'attachment_path'          => $attachmentPath,
            'attachment_original_name' => $attachmentOriginalName,
        ];
    }
}
