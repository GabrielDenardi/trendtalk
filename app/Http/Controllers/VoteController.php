<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function vote(Request $request, Post $post)
    {
        $request->validate([
            'value' => 'required|in:1,-1',
        ]);

        $user = auth()->user();

        $existingVote = $post->votes()->where('user_id', $user->id)->first();

        if ($existingVote) {
            if ($existingVote->value == $request->value) {
                $existingVote->delete();
            } else {
                $existingVote->update(['value' => $request->value]);
            }
        } else {
            $post->votes()->create([
                'user_id' => $user->id,
                'value' => $request->value,
            ]);
        }

        return redirect()->back();
    }
}


