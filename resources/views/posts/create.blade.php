<!-- resources/views/posts/create.blade.php -->
<title>Novo Post</title>
<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Publicar</h1>

            @if ($errors->any())
                <div class="bg-red-100 dark:bg-red-200 text-red-700 dark:text-red-800 p-4 rounded mb-6">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('title') }}" required>
                </div>

                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Conteúdo</label>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                        Você pode formatar seu conteúdo usando <a href="https://www.markdownguide.org/basic-syntax/" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">Markdown</a>.
                    </p>
                    <textarea name="content" id="content">{{ old('content') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 mr-4">Cancelar</a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">Publicar</button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var easyMDE = new EasyMDE({
                    element: document.getElementById('content'),
                    spellChecker: false,
                    autosave: {
                        enabled: true,
                        uniqueId: "post_content",
                        delay: 1000,
                    },
                    toolbar: [
                        "bold", "italic", "heading", "|",
                        "quote", "unordered-list", "ordered-list", "|",
                        "link", "image", "|",
                        "preview", "side-by-side", "fullscreen", "|",
                        {
                            name: "guide",
                            action: function customFunction(editor){
                                window.open('https://www.markdownguide.org/basic-syntax/', '_blank');
                            },
                            className: "fa fa-question-circle",
                            title: "Guia de Markdown",
                        }
                    ],
                });
            });
        </script>
    @endpush
</x-app-layout>
