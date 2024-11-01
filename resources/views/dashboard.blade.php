<title>Página Inicial / TrendTalk</title>

<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-end mb-4">
            <a href="{{ route('posts.create') }}" class="text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md">
                Novo Post
            </a>
        </div>

        <div class="space-y-4">
            @foreach ($posts as $post)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <div class="flex items-start">
                        <div class="flex flex-col items-center mr-4">
                            <!-- Formulário de Upvote -->
                            <form id="upvote-form-{{ $post->id }}" action="{{ route('posts.vote', $post) }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="value" value="1">
                            </form>
                            <button class="text-gray-500 hover:text-green-500" onclick="event.preventDefault(); document.getElementById('upvote-form-{{ $post->id }}').submit();">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 15l7-7 7 7"></path>
                                </svg>
                            </button>

                            <span class="text-gray-700 dark:text-gray-300 font-medium my-1">{{ $post->votes_count }}</span>

                            <form id="downvote-form-{{ $post->id }}" action="{{ route('posts.vote', $post) }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="value" value="-1">
                            </form>
                            <button class="text-gray-500 hover:text-red-500" onclick="event.preventDefault(); document.getElementById('downvote-form-{{ $post->id }}').submit();">
                                <svg class="w-6 h-6 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 15l7-7 7 7"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="flex-1">
                            <a href="{{ route('posts.show', $post) }}">
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white hover:underline">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Por <a href="{{ route('users.show', $post->user) }}" class="font-medium text-gray-800 dark:text-gray-200 hover:underline">
                                    {{ $post->user->username }} </a> • {{ $post->created_at->diffForHumans() }}
                            </p>
                            <div class="mt-2 flex items-center space-x-4">
                                <a href="{{ route('posts.show', $post) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                    Ler mais
                                </a>
                                <span class="text-gray-500 dark:text-gray-400 text-sm">
                                    {{ $post->comments_count }} comentários
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
