<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        if ($request->has('filter') && $request->filter == 'top') {
            $query->withCount('votes')->orderBy('votes_count', 'desc');
        }

        $posts = Post::with('user')
            ->withCount([
                'votes as votes_count' => function ($query) {
                    $query->select(DB::raw('COALESCE(SUM(value), 0)'));
                },
                'comments'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = auth()->id();
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post publicado com sucesso!');
    }

    public function show(Post $post)
    {
        $post->load('user', 'comments.user');

        return view('posts.show', compact('post'));
    }


}
