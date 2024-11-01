<!-- resources/views/explore/search.blade.php -->
<title>{{ $query }} - Buscar / TrendTalk</title>
<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('explore.search') }}" method="GET" class="mb-8">
                <div class="relative">
                    <input type="text" name="query" value="{{ $query }}" placeholder="Buscar posts..." class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md py-2 px-4 focus:ring-indigo-500 focus:border-indigo-500">
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l5.386 5.385-1.414 1.415-5.386-5.386zM8 14a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>

            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                Resultados para "{{ $query }}"
            </h2>

            @forelse ($posts as $post)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-4">
                    <a href="{{ route('posts.show', $post) }}">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white hover:underline">
                            {{ $post->title }}
                        </h3>
                    </a>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Por <a href="{{ route('users.show', $post->user) }}" class="font-medium text-gray-800 dark:text-gray-200 hover:underline">
                            {{ $post->user->username }}
                        </a> • {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">Nenhum post encontrado.</p>
            @endforelse

            <div>
                {{ $posts->appends(['query' => $query])->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
