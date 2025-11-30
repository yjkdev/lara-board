<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4 space-y-10">

        {{-- 게시글 카드 --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 px-6 py-6">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">
                        {{ $post->title }}
                    </h1>
                    <div class="flex gap-3 text-xs text-gray-500">
                        <span>작성자: {{ $post->user->name }}</span>
                        <span>·</span>
                        <span>작성일: {{ $post->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>

                @if($post->user_id === auth()->id())
                    <div class="flex gap-2">
                        <a href="{{ route('posts.edit', $post->id) }}"
                           class="px-3 py-1.5 text-xs font-semibold rounded-full bg-amber-500 text-white hover:bg-amber-600 transition">
                            수정
                        </a>

                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                              onsubmit="return confirm('정말 삭제할까요?');">
                            @csrf
                            @method('DELETE')
                            <button
                                class="px-3 py-1.5 text-xs font-semibold rounded-full bg-red-600 text-white hover:bg-red-700 transition">
                                삭제
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <div class="mt-4 text-gray-800 whitespace-pre-line leading-relaxed">
                {{ $post->content }}
            </div>

            {{-- 첨부파일 --}}
            @if($post->attachment_path)
                <div class="mt-6 inline-flex items-center gap-2 px-3 py-2 bg-blue-50 border border-blue-100 rounded-full">
                    <span class="text-xs text-blue-600 font-semibold">첨부파일</span>
                    <a href="{{ asset('storage/'.$post->attachment_path) }}"
                       class="text-sm text-blue-700 underline"
                       download>
                        {{ $post->attachment_original_name }}
                    </a>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('posts.index') }}" class="text-sm text-gray-500 hover:text-blue-600">
                    ← 목록으로
                </a>
            </div>
        </div>

        {{-- 댓글 섹션 --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 px-6 py-6">
            <h2 class="text-lg font-semibold mb-4">댓글</h2>

            {{-- 댓글 목록 --}}
            <div class="space-y-3">
                @forelse($post->comments as $comment)
                    <div class="border border-gray-100 rounded-xl px-4 py-3">
                        <div class="flex items-start justify-between gap-3">
                            <p class="text-sm text-gray-800">
                                {{ $comment->content }}
                            </p>
                            <div class="text-right text-[11px] text-gray-400 whitespace-nowrap">
                                <div>{{ $comment->user->name }}</div>
                                <div>{{ $comment->created_at->format('Y-m-d H:i') }}</div>
                            </div>
                        </div>

                        @if(auth()->id() === $comment->user_id)
                            <form action="{{ route('comments.destroy', $comment->id) }}"
                                  method="POST"
                                  class="mt-2 text-right">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="inline-flex items-center px-2 py-1 text-[11px] text-red-600 border border-red-200 rounded-full hover:bg-red-50 transition">
                                    댓글 삭제
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-400">아직 댓글이 없습니다. 첫 댓글을 남겨보세요 🙂</p>
                @endforelse
            </div>

            {{-- 댓글 작성 폼 --}}
            <div class="mt-6">
                @auth
                    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="space-y-2">
                        @csrf
                        <textarea name="content"
                                  class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  rows="3"
                                  placeholder="댓글을 입력하세요" required></textarea>
                        <div class="text-right">
                            <button
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">
                                댓글 등록
                            </button>
                        </div>
                    </form>
                @else
                    <p class="text-sm text-gray-400">댓글을 작성하려면 로그인하세요.</p>
                @endauth
            </div>
        </div>

    </div>
</x-app-layout>