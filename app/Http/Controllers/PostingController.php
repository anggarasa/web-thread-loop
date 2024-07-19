<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use App\Models\Posting;
use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class PostingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi' => 'required',
            'posting_image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:51200', // 50MB for images
            'posting_video' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:102400', // 100MB for videos
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $pathimage = null;
        $pathvideo = null;

        try {
            if ($request->hasFile('posting_image')) {
                $pathimage = $request->file('posting_image')->store('posting-image');
            } elseif ($request->hasFile('posting_video')) {
                $pathvideo = $request->file('posting_video')->store('posting-image');
            }

            // Generate a random slug
            $slug = Str::uuid();
            
            $post = Posting::create([
                'user_id' => auth()->id(),
                'deskripsi' => $request->deskripsi,
                'slug' => $slug,
                'posting_image' => $pathimage,
                'posting_video' => $pathvideo
            ]);

            // Dapatkan semua pengikut pengguna yang mengupload postingan
            $followers = User::whereHas('followers', function ($query) {
                $query->where('follower_id', auth()->id());
            })->get();

            // Debug log
            logger()->info('Pengikut:', ['followers' => $followers->toArray()]);

            foreach ($followers as $follower) {
                Activity::create([
                    'user_id' => auth()->id(),
                    'post_id' => $post->id,
                    'type' => 'upload_post',
                    'receiver_id' => $follower->id, // Set receiver_id untuk setiap pengikut
                ]);
            }

            return back()->with('success', 'Postingan Berhasil Dibuat!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuat postingan. Silakan coba lagi.');
        }
    }

    
    public function destroy($id)
    {
        try {
            $post = Posting::findOrFail($id);
        
            // Hapus komentar yang terkait dengan postingan ini
            Comment::where('posting_id', $id)->delete();
        
            // Hapus gambar jika ada
            if ($post->posting_image) {
                Storage::delete($post->posting_image);
            }
        
            // Hapus video jika ada
            if ($post->posting_video) {
                Storage::delete($post->posting_video);
            }
        
            // Hapus postingan
            $post->delete();
        
            return back()->with('success', 'Berhasil Menghapus Postingan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus postingan. Silakan coba lagi.');
        }
    }
}

