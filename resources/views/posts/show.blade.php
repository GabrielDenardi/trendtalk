<!-- resources/views/posts/show.blade.php -->
<title>{{$post->title}}</title>
<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="max-w-3xl mx-auto">
            <!-- Título do Post -->
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                {{ $post->title }}
            </h1>
            <div class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                Por <a href="{{ route('users.show', $post->user) }}" class="font-medium text-gray-800 dark:text-gray-200 hover:underline">
                    {{ $post->user->username }}
                </a> • {{ $post->created_at->diffForHumans() }}
            </div>

            <!-- Conteúdo do Post -->
            <div class="prose dark:prose-invert max-w-none">
                {!! Str::markdown($post->content) !!}
            </div>

            <!-- Seção de Comentários -->
            <div id="comments" class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Comentários</h2>

                <!-- Formulário para Adicionar Comentário -->
                @auth
                    <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6">
                        @csrf
                        <textarea name="content" rows="4" class="mt-1 block w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Deixe um comentário..." required></textarea>
                        <div class="flex justify-end mt-2">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">Comentar</button>
                        </div>
                    </form>
                @endauth

                <!-- Lista de Comentários -->
                <div class="space-y-6">
                    @php
                        // Recuperar todos os comentários do post, com o usuário
                        $comments = $post->comments()->with('user')->get();

                        // Criar um mapa de comentários pelo ID
                        $commentsById = $comments->keyBy('id');

                        // Coleção para armazenar os comentários de nível superior
                        $topLevelComments = collect();

                        // Construir a árvore de comentários
                        foreach ($comments as $comment) {
                            if ($comment->parent_id) {
                                // Se o comentário tem um parent_id, ele é uma resposta
                                if ($commentsById->has($comment->parent_id)) {
                                    $parent = $commentsById[$comment->parent_id];
                                    $parent->children = $parent->children ?? collect();
                                    $parent->children->push($comment);
                                }
                            } else {
                                // Comentários de nível superior
                                $topLevelComments->push($comment);
                            }
                        }

                        // Função para exibir os comentários
                        function display_comments($comments, $post, $level = 0)
                        {
                            // Definir um array de classes de recuo
                            $indentationClasses = [
                                0 => '',
                                1 => 'ml-4',
                                2 => 'ml-8',
                                3 => 'ml-12',
                                4 => 'ml-16',
                                5 => 'ml-20',
                                // Adicione mais se necessário
                            ];

                            foreach ($comments as $comment) {
                                // Obter a classe de recuo com base no nível
                                $indentClass = $indentationClasses[$level] ?? 'ml-20';

                                echo '<div class="mb-4 '.$indentClass.'">';
                                echo '<div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg">';

                                // Linha de informações do comentário
                                echo '<div class="flex items-center text-sm text-gray-600 dark:text-gray-400">';

                                // Adicionar seta se for uma resposta
                                if ($level > 0) {
                                    echo '<svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                                    echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m0 0l6-6m-6 6l6 6" />';
                                    echo '</svg>';
                                }

                                echo '<a href="'.route('users.show', $comment->user).'" class="font-medium text-gray-800 dark:text-gray-200 hover:underline">'.$comment->user->username.'</a>';
                                echo ' • '.$comment->created_at->diffForHumans();
                                echo '</div>';

                                // Conteúdo do comentário
                                echo '<div class="mt-2 text-gray-800 dark:text-gray-200">';
                                echo Str::markdown($comment->content);
                                echo '</div>';

                                // Botão de Responder
                                if (auth()->check()) {
                                    echo '<button class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline mt-2" onclick="toggleReplyForm('.$comment->id.')">Responder</button>';

                                    // Formulário de Resposta
                                    echo '<div id="reply-form-'.$comment->id.'" class="hidden mt-2">';
                                    echo '<form action="'.route('comments.store', $post).'" method="POST">';
                                    echo csrf_field();
                                    echo '<input type="hidden" name="parent_id" value="'.$comment->id.'">';
                                    echo '<textarea name="content" rows="2" class="mt-1 block w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Sua resposta..." required></textarea>';
                                    echo '<div class="flex justify-end mt-2">';
                                    echo '<button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">Enviar</button>';
                                    echo '</div>';
                                    echo '</form>';
                                    echo '</div>';
                                }

                                echo '</div>';

                                // Exibir respostas
                                if (isset($comment->children) && $comment->children->count() > 0) {
                                    display_comments($comment->children, $post, $level + 1);
                                }

                                echo '</div>';
                            }
                        }

                        // Chamar a função para exibir os comentários
                        display_comments($topLevelComments, $post);
                    @endphp
                </div>
            </div>
        </div>

        <!-- Script para alternar o formulário de resposta -->
        <script>
            function toggleReplyForm(commentId) {
                const form = document.getElementById('reply-form-' + commentId);
                form.classList.toggle('hidden');
            }
        </script>

</x-app-layout>
