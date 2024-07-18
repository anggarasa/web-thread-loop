<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Posting;
use App\Models\Activity;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CommentController extends Controller
{
    public function store(Request $request, Posting $post)
    {
        $request->validate([
            'content' => 'required|min:3|max:100',
        ]);

        $post = Posting::findOrFail($request->posting_id);
 
        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->posting_id = $post->id;
        $comment->content = $request->content;
        $comment->save();
 
        $comment->load('user');

        Activity::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'type' => 'comment',
            'content' => $comment->content,
            'receiver_id' => $post->user_id,
        ]);

        alert()->success('Success','Komentar berhasil di upload');
 
        return response()->json([
            'comment' => $comment,
            'user' => $comment->user
        ]);
    }

    public function storeTeks(Request $request)
    {
        $request->validate([
            'content' => 'required|min:3|max:100',
        ]);

        $post = Posting::findOrFail($request->posting_id);
 
        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->posting_id = $post->id;
        $comment->content = $request->content;
        $comment->save();
 
        $comment->load('user');

        Activity::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'type' => 'comment',
            'content' => $comment->content,
            'receiver_id' => $post->user_id,
        ]);

        return back();
    }
}

