<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 px-6 py-6">
            <h1 class="text-2xl font-bold mb-6">댓글 수정</h1>

            <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold mb-1.5">내용</label>
                    <textarea name="content"
                              class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm h-32 resize-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              required>{{ old('content', $comment->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('posts.show', $comment->post_id) }}"
                       class="px-4 py-2 text-sm text-gray-500 rounded-full hover:bg-gray-100">
                        취소
                    </a>
                    <button
                        class="px-4 py-2 text-sm font-semibold bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">
                        수정 완료
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
