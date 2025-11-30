<x-app-layout>
    <div class="max-w-3xl mx-auto py-8">

        <h2 class="text-2xl font-bold mb-6">글 수정</h2>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1">제목</label>
                <input type="text" name="title" value="{{ $post->title }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">내용</label>
                <textarea name="content" class="w-full border rounded px-3 py-2 h-40"
                          required>{{ $post->content }}</textarea>
            </div>

            <button
                class="px-4 py-2 bg-yellow-500 text-white rounded-md">
                수정
            </button>
        </form>

    </div>
</x-app-layout>
