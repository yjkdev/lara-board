<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 px-6 py-6">
            <h1 class="text-2xl font-bold mb-6">새 글 작성</h1>

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold mb-1.5">제목</label>
                    <input type="text" name="title"
                           class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">첨부파일 (선택)</label>
                    <input type="file" name="attachment"
                           class="w-full text-sm text-gray-600">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">내용</label>
                    <textarea name="content"
                              class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm h-48 resize-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              required></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('posts.index') }}"
                       class="px-4 py-2 text-sm text-gray-500 rounded-full hover:bg-gray-100">
                        취소
                    </a>
                    <button
                        class="px-5 py-2 text-sm font-semibold bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">
                        등록
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
