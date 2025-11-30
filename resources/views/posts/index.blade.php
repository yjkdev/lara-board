<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">

        {{-- 상단 헤더 --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">게시글 목록</h1>
                <p class="mt-1 text-sm text-gray-500">
                    총 {{ $posts->total() }}개의 글이 있습니다.
                </p>
            </div>

            @auth
                <a href="{{ route('posts.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-full shadow-sm hover:bg-blue-700 transition">
                    <span class="text-lg leading-none">＋</span>
                    글 쓰기
                </a>
            @endauth
        </div>

        {{-- 글 목록 --}}
        <div class="space-y-4">
            @forelse($posts as $post)
                <a href="{{ route('posts.show', $post->id) }}"
                   class="block bg-white border border-gray-200 rounded-2xl px-5 py-4 shadow-sm hover:shadow-md hover:border-blue-300 transition">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-1">
                                {{ $post->title }}
                            </h2>
                            <p class="text-sm text-gray-500">
                                {{ \Illuminate\Support\Str::limit($post->content, 80) }}
                            </p>
                        </div>
                        <div class="flex flex-col items-end gap-1 text-xs text-gray-400">
                            <span>작성자: {{ $post->user->name }}</span>
                            <span>{{ $post->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="bg-white border border-dashed border-gray-300 rounded-2xl px-6 py-10 text-center text-gray-400">
                    아직 작성된 글이 없습니다.<br>
                    첫 글의 주인공이 되어보세요 ✏️
                </div>
            @endforelse
        </div>

        {{-- 페이지네이션 --}}
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
