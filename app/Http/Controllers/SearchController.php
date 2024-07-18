<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posting;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Eager load relasi yang diperlukan
        $users = User::with(['followers', 'following', 'postings'])
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")
            ->get();

        $posts = Posting::with(['user', 'likes', 'comments.user'])
            ->where('deskripsi', 'LIKE', "%{$query}%")
            ->get();

        return view('user-login.fit-cari.cari', compact('users', 'posts'), [
            'title' => 'Cari'
        ]);
    }
    
    public function searchGuest(Request $request)
    {
        $query = $request->input('query');

        // Eager load relasi yang diperlukan
        $users = User::with(['followers', 'following', 'postings'])
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")
            ->get();

        $posts = Posting::with(['user', 'likes', 'comments.user'])
            ->where('deskripsi', 'LIKE', "%{$query}%")
            ->get();

        return view('guest.cari', compact('users', 'posts'), [
            'title' => 'Search'
        ]);
    }
}
