<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class ExploreController extends Controller
{
    public function index()
    {
        $trendingTopics = DB::table('trending_topics')->orderBy('count', 'desc')->take(10)->get();

        return view('explore.index', compact('trendingTopics'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->paginate(10);

        return view('explore.search', compact('posts', 'query'));
    }
}
