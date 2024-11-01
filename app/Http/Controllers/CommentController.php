<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comentário adicionado com sucesso!');
    }
}
