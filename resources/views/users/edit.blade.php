<!-- resources/views/users/edit.blade.php -->

<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">Editar Perfil</h1>

            @if ($errors->any())
                <div class="bg-red-100 dark:bg-red-200 text-red-700 dark:text-red-800 p-4 rounded mb-6">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update') }}" method="POST">
                @csrf

                <!-- Nome de Usuário -->
                <div class="mb-6">
                    <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome de Usuário</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="mt-1 block w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Seu nome de usuário">
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Seu email">
                </div>

                <!-- Bio -->
                <div class="mb-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sobre mim</label>
                    <textarea name="bio" id="bio" rows="5" class="mt-1 block w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Fale um pouco sobre você">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <!-- Botões -->
                <div class="flex justify-end">
                    <a href="{{ route('users.show', $user) }}" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 mr-4">Cancelar</a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
