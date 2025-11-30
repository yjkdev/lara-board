<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">

        <h2 class="text-3xl font-bold mb-3">{{ $post->title }}</h2>
        <p class="text-gray-500 mb-6">작성자: {{ $post->user->name }}</p>

        <div class="mb-10 whitespace-pre-line">
            {{ $post->content }}
        </div>

        @if($post->attachment_path)
            <div class="mt-4 mb-8">
                <a href="{{ \Illuminate\Support\Facades\Storage::url($post->attachment_path) }}"
                  class="text-blue-600 underline" download>
                    첨부파일 다운로드 ({{ $post->attachment_original_name }})
                </a>
            </div>
        @endif

        @if($post->user_id === auth()->id())
            <div class="flex gap-3 mb-8">
                <a href="{{ route('posts.edit', $post->id) }}"
                   class="px-4 py-2 bg-yellow-500 text-white rounded-md">
                    수정
                </a>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 bg-red-600 text-white rounded-md">
                        삭제
                    </button>
                </form>
            </div>
        @endif

        <div class="mt-2 mb-6">
            <a href="{{ route('posts.index') }}" class="text-blue-600">← 목록으로</a>
        </div>

        <h3 class="text-xl font-semibold mt-10 mb-4">댓글</h3>

        {{-- 댓글 목록 --}}
        @forelse($post->comments as $comment)
            <div class="border rounded p-3 mb-3">
                <p class="mb-1">{{ $comment->content }}</p>
                <p class="text-xs text-gray-500">작성자: {{ $comment->user->name }}</p>

                @if(auth()->id() === $comment->user_id)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="px-2 py-1 text-sm bg-red-600 text-white rounded">
                            댓글 삭제
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <p class="text-gray-500">첫 댓글을 남겨보세요.</p>
        @endforelse

        {{-- 댓글 작성 폼 --}}
        @auth
            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-4 space-y-2">
                @csrf
                <textarea name="content" class="w-full border rounded px-3 py-2" rows="3"
                          placeholder="댓글을 입력하세요" required></textarea>
                <button class="px-3 py-2 bg-blue-600 text-white rounded">
                    댓글 등록
                </button>
            </form>
        @else
            <p class="mt-4 text-sm text-gray-500">댓글을 작성하려면 로그인하세요.</p>
        @endauth

    </div>
</x-app-layout>
