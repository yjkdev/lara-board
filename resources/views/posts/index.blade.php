<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">게시글 목록</h2>

            @auth
                <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">
                    글쓰기
                </a>
            @endauth
        </div>

        @foreach($posts as $post)
            <div class="border-b py-4">
                <a href="{{ route('posts.show', $post->id) }}" class="text-xl font-semibold">
                    {{ $post->title }}
                </a>

                <p class="text-gray-500 text-sm">작성자: {{ $post->user->name }}</p>
            </div>
        @endforeach

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
