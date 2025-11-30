<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 px-6 py-6">
            <h1 class="text-2xl font-bold mb-6">글 수정</h1>

            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold mb-1.5">제목</label>
                    <input type="text" name="title" value="{{ $post->title }}"
                           class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">첨부파일 변경 (선택)</label>
                    <input type="file" name="attachment"
                           class="w-full text-sm text-gray-600">
                    @if($post->attachment_path)
                        <p class="mt-1 text-xs text-gray-400">
                            현재 파일: {{ $post->attachment_original_name }}
                        </p>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">내용</label>
                    <textarea name="content"
                              class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm h-48 resize-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              required>{{ $post->content }}</textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('posts.show', $post->id) }}"
                       class="px-4 py-2 text-sm text-gray-500 rounded-full hover:bg-gray-100">
                        취소
                    </a>
                    <button
                        class="px-5 py-2 text-sm font-semibold bg-amber-500 text-white rounded-full hover:bg-amber-600 transition">
                        수정 완료
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
