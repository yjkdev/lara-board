<x-guest-layout>
    <div class="text-center">
        {{-- 제목 / 설명 --}}
        <h1
            class="font-semibold text-gray-900 mb-2"
            style="font-size: 36px; line-height: 1.2;"
        >
            Welcome Laravel Board
        </h1>
        <p class="text-sm text-gray-600 mb-6">
            2401195_김대겸_라라벨게시판
        </p>

        {{-- 버튼 영역 --}}
        @if (Route::has('login'))
            <div class="flex items-center justify-center gap-4">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="inline-flex items-center justify-center px-6 py-2.5
                               rounded-md text-sm font-medium
                               border border-gray-300 bg-white text-gray-800
                               hover:bg-gray-50 hover:border-gray-400
                               transition-colors"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent
                            rounded-md font-semibold text-xs text-white uppercase tracking-widest
                            hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                            focus:ring-indigo-500 transition ease-in-out duration-150"
                    >
                        {{ __('Log in') }}
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent
                                rounded-md font-semibold text-xs text-white uppercase tracking-widest
                                hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 transition ease-in-out duration-150"
                        >
                            {{ __('Register') }}
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</x-guest-layout>