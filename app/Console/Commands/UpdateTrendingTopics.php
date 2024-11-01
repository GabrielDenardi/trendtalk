<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateTrendingTopics extends Command
{
    protected $signature = 'trending:update';
    protected $description = 'Atualiza os assuntos do momento com base nas palavras mais usadas nas postagens';

    public function handle()
    {
        DB::table('trending_topics')->truncate();

        $posts = Post::all();

        $wordCounts = [];

        foreach ($posts as $post) {
            $content = $post->title . ' ' . $post->content;
            $words = str_word_count(strip_tags($content), 1);

            foreach ($words as $word) {
                $word = Str::lower($word);
                $word = preg_replace('/[^a-zà-úÀ-Ú0-9]/', '', $word);

                if (strlen($word) > 3) {
                    if (!isset($wordCounts[$word])) {
                        $wordCounts[$word] = 1;
                    } else {
                        $wordCounts[$word]++;
                    }
                }
            }
        }

        arsort($wordCounts);
        $topWords = array_slice($wordCounts, 0, 50, true);

        foreach ($topWords as $word => $count) {
            DB::table('trending_topics')->insert([
                'word' => $word,
                'count' => $count,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info('Assuntos do momento atualizados com sucesso!');
    }
}
