<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">

        <h2 class="text-3xl font-bold mb-3">{{ $post->title }}</h2>
        <p class="text-gray-500 mb-6">작성자: {{ $post->user->name }}</p>

        <div class="mb-10 whitespace-pre-line">
            {{ $post->content }}
        </div>

        @if($post->user_id === auth()->id())
            <div class="flex gap-3">
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

        <div class="mt-8">
            <a href="{{ route('posts.index') }}" class="text-blue-600">← 목록으로</a>
        </div>

    </div>
</x-app-layout>
