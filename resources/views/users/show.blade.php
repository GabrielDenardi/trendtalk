<!-- resources/views/users/show.blade.php -->
<title>{{$user->username}} / TrendTalk</title>
<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-2">
                {{ $user->username }}
            </h1>

            @if ($user->bio)
                <p class="text-gray-700 dark:text-gray-300 mt-2">
                    {{ $user->bio }}
                </p>
            @else
                <p class="text-gray-500 dark:text-gray-400 mt-2">
                    Este usuário ainda não adicionou uma descrição.
                </p>
            @endif

            @if (auth()->id() === $user->id)
                <div class="mt-4">
                    <a href="{{ route('users.edit') }}" class="text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md">
                        Editar Perfil
                    </a>
                </div>
            @endif
        </div>

        <div class="max-w-3xl mx-auto">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Publicações</h2>

            @forelse ($posts as $post)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-4">
                    <a href="{{ route('posts.show', $post) }}">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white hover:underline">
                            {{ $post->title }}
                        </h3>
                    </a>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $post->created_at->format('d M Y') }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">Este usuário ainda não publicou nada.</p>
            @endforelse

            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
