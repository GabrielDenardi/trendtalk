<!-- resources/views/explore/index.blade.php -->
<title>Explorar / TrendTalk</title>
<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">
                Explorar
            </h1>

            <form action="{{ route('explore.search') }}" method="GET" class="mb-8">
                <div class="relative">
                    <input type="text" name="query" placeholder="Buscar posts..." class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md py-2 px-4 focus:ring-indigo-500 focus:border-indigo-500">
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l5.386 5.385-1.414 1.415-5.386-5.386zM8 14a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>

            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                Assuntos do Momento
            </h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($trendingTopics as $topic)
                    <a href="{{ route('explore.search', ['query' => $topic->word]) }}" class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-md hover:bg-indigo-600 hover:text-white">
                        #{{ $topic->word }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
