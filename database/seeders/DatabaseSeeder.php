<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) 고정 계정 5개 생성
        $fixedUsersData = [
            ['name' => '김종율교수', 'email' => 'jia3@naver.com'],
            ['name' => '김대겸학생', 'email' => 'jia4@naver.com'],
            ['name' => '설수현학생', 'email' => 'jia5@naver.com'],
            ['name' => '김영진학생', 'email' => 'jia6@naver.com'],
            ['name' => '홍태관학생', 'email' => 'jia7@naver.com'],
        ];

        $users = collect();

        foreach ($fixedUsersData as $data) {
            $users->push(
                User::create([
                    'name'              => $data['name'],
                    'email'             => $data['email'],
                    'password'          => Hash::make('jittest'), // 공통 비밀번호
                    'email_verified_at' => now(),
                ])
            );
        }

        // 2) 게시글 30개 생성 (작성자: 위 유저들 중 랜덤)
        $posts = Post::factory()->count(30)->make()->each(function ($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });

        // 3) 댓글 60개 생성 (작성자/게시글 모두 랜덤)
        Comment::factory()->count(60)->make()->each(function ($comment) use ($users, $posts) {
            $comment->user_id = $users->random()->id;
            $comment->post_id = $posts->random()->id;
            $comment->save();
        });
    }
}