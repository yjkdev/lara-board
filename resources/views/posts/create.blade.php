<x-app-layout>
    <div class="max-w-3xl mx-auto py-8">

        <h2 class="text-2xl font-bold mb-6">글 작성</h2>

        <form action="{{ route('posts.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf

            <div>
                <label class="block font-semibold mb-1">제목</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2"
                       required>
            </div>
            
            <div>
              <label class="block font-semibold mb-1">첨부파일</label>
              <input type="file" name="attachment">
            </div>
            
            <div>
                <label class="block font-semibold mb-1">내용</label>
                <textarea name="content" class="w-full border rounded px-3 py-2 h-40"
                          required></textarea>
            </div>

            <button
                class="px-4 py-2 bg-blue-600 text-white rounded-md">
                등록
            </button>
        </form>

    </div>
</x-app-layout>
