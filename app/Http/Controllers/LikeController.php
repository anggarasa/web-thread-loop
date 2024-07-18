<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Posting;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $posting_id = $request->input('posting_id');
        $user_id = Auth::id();

        // Memastikan postingan yang di-like ada
        $post = Posting::findOrFail($posting_id);

        // Membuat like baru
        $like = new Like();
        $like->posting_id = $posting_id;
        $like->user_id = $user_id;
        $like->save();

        // Menghitung jumlah like
        $likes_count = $post->likes()->count();

        // Membuat aktivitas baru
        Activity::create([
            'user_id' => $user_id,
            'post_id' => $post->id,
            'type' => 'like',
            'receiver_id' => $post->user_id, // Set receiver_id ke pemilik postingan
        ]);

        return response()->json(['status' => 'liked', 'likes_count' => $likes_count]);
    }

    public function unlike(Request $request)
    {
        $posting_id = $request->input('posting_id');
        $user_id = Auth::id();

        Like::where('posting_id', $posting_id)->where('user_id', $user_id)->delete();

        $likes_count = Posting::find($posting_id)->likes()->count();

        return response()->json(['status' => 'unliked', 'likes_count' => $likes_count]);
    }
}
