<!-- resources/views/sobre.blade.php -->
<title>Sobre / TrendTalk</title>
<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-6">
                Sobre o TrendTalk
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 mb-12">
                O TrendTalk é uma plataforma de discussão onde você pode compartilhar suas ideias, responder a perguntas e interagir com uma comunidade apaixonada por conhecimento.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Nossa Missão
                </h2>
                <p class="text-gray-700 dark:text-gray-300">
                    Minha missão é conectar pessoas através de ideias e promover discussões significativas que inspirem aprendizado e crescimento.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Nossos Valores
                </h2>
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                    <li>Comunidade</li>
                    <li>Conhecimento</li>
                    <li>Respeito</li>
                    <li>Inovação</li>
                </ul>
            </div>
        </div>

        <div class="max-w-4xl mx-auto text-center mt-12">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">
                Junte-se à Conversa!
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 mb-6">
                Comece a compartilhar suas ideias e participe de discussões incríveis hoje mesmo.
            </p>

            @guest
                <a href="{{ route('register') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md text-lg font-medium">
                    Cadastre-se Agora
                </a>
            @else
                <a href="{{ route('posts.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md text-lg font-medium">
                    Criar Novo Post
                </a>
            @endguest
        </div>
    </div>
</x-app-layout>
