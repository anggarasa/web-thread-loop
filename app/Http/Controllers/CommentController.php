<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Posting;
use App\Models\Activity;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function commentDestroy($postingId, $commentId)
    {
        // Temukan posting berdasarkan ID
        $posting = Posting::find($postingId);

        // Periksa apakah posting ditemukan
        if (!$posting) {
            return response()->json([
                'status' => 'error',
                'message' => 'Posting tidak ditemukan.'
            ], 404);
        }

        // Temukan komentar berdasarkan ID dan posting ID
        $comment = Comment::where('id', $commentId)->where('posting_id', $posting->id)->first();

        // Periksa apakah komentar ditemukan dan apakah pengguna yang menghapus adalah pemilik komentar atau posting
        if ($comment && (Auth::id() == $comment->user_id || Auth::id() == $posting->user_id)) {
            $comment->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Komentar berhasil dihapus.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Komentar tidak ditemukan atau tidak memiliki izin untuk menghapus.'
        ], 403);
    }
    
    public function commentDestroyTeks($posting_id, $comment_id)
    {
        $comment = Comment::where('id', $comment_id)->where('posting_id', $posting_id)->firstOrFail();

    // Hanya pengguna yang membuat komentar atau pemilik postingan yang bisa menghapus komentar
    if (auth()->id() === $comment->user_id || auth()->id() === $comment->posting->user_id) {
        $comment->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus');
    }

    return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini');
    }
}

