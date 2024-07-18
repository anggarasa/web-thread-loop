<?php

use App\Models\User;
use App\Models\Posting;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostingController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckNewActivities;

Route::middleware('guest')->group(function() {
    Route::get('/', function() {
        return view('splash', [
            'title' => 'intro'
        ]);
    });

    Route::get('/Beranda', function () {
        $posts = Posting::inRandomOrder()
        ->with(['likes', 'user', 'comments.user'])
        ->get();
        return view('guest.beranda', compact('posts'), [
            'title' => 'Beranda'
        ]);
    });

    Route::get('/search', [SearchController::class, 'searchGuest'])->name('cari-guest');

    // Show Posting Teks
    Route::get('/showTeks-guest/{posting:slug}', function (Posting $posting) {
        return view('guest.show-teks-gues', [
            'title' => 'Detail User',
            'tek' => $posting->load(['user', 'likes', 'comments.user'])
        ]);
    });

    // profile-user-guest
    Route::get('/profile-user-guest/{user:username}', function (User $user) {
        $posts = Posting::with('comments.user', 'user', 'likes')->where('user_id', $user->id)->latest()->get();
        $teks = Posting::select('deskripsi', 'slug', 'created_at', 'user_id', 'id')
            ->where('user_id', $user->id)
            ->whereNull('posting_image')
            ->whereNull('posting_video')
            ->latest()
            ->get();
        return view('guest.profile-guest', compact('user', 'posts', 'teks'), [
            'title' => 'Profile - ' . $user->username,
        ]);
    })->name('kunjungan-profile-guest');
});

// Route User Yang Sudah Login
Route::middleware(['auth', 'verified', 'web', CheckNewActivities::class])->group(function() {
    Route::get('/Home', function () {
        $posts = Posting::inRandomOrder()
            ->with(['likes', 'user', 'comments.user'])
            ->get();
    
        $users = User::where('id', '!=', auth()->id())
            ->with(['followers', 'following'])
            ->inRandomOrder()
            ->take(5)
            ->get();
    
        return view('user-login.home', compact('posts', 'users'), [
            'title' => 'Home'
        ]);
    })->name('dashboard');

    Route::get('/profile-user', function () {
        $user = Auth::user();
        $posts = Posting::with('comments.user', 'user', 'likes')->where('user_id', auth()->id())->latest()->get();
        $teks = Posting::select('deskripsi', 'slug', 'created_at', 'user_id', 'id')
            ->where('user_id', auth()->id())
            ->whereNull('posting_image')
            ->whereNull('posting_video')
            ->latest()
            ->get();
        return view('user-login.profile', compact('user', 'posts', 'teks'), [
            'title' => 'Profile'
        ]);
    })->name('profile');
    
    // mengunjungi profile seseorang
    Route::get('/profile-user/{user:username}', function (User $user) {
        $posts = Posting::with('comments.user', 'user', 'likes')->where('user_id', $user->id)->latest()->get();
        $teks = Posting::select('deskripsi', 'slug', 'created_at', 'user_id', 'id')
            ->where('user_id', $user->id)
            ->whereNull('posting_image')
            ->whereNull('posting_video')
            ->latest()
            ->get();
        return view('user-login.profile', compact('user', 'posts', 'teks'), [
            'title' => 'Profile - ' . $user->username,
        ]);
    })->name('kunjungan-profile');

    Route::get('/edit-password', function () {
        return view('profile.edit', [
            'title' => 'Edit Password'
        ]);
    })->name('edit-password');

    Route::get('/cari', [SearchController::class, 'search'])->name('fit-cari');

    // Show Posting Teks
    Route::get('/showTeks/{posting:slug}', function (Posting $posting) {
        return view('user-login.show-teks-user', [
            'title' => 'Detail User',
            'tek' => $posting->load(['user', 'likes', 'comments.user'])
        ]);
    });

    // Activity 
    Route::get('/activity', function() {
        $activities = Activity::with(['user', 'post.user', 'receiver'])
            ->where('receiver_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        // Tandai aktivitas sebagai sudah dibaca
        Activity::where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
        return view('user-login.activity', compact('activities'), [
            'title' => 'Activity'
        ]);
    });

    // Posting
    Route::post('/posting', [PostingController::class, 'store'])->name('posting.store');
    Route::delete('/posting/{id}', [PostingController::class, 'destroy'])->name('posting.destroy');

    // Comment
    Route::post('/comments', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/comments-teks', [CommentController::class, 'storeTeks']);
    // Route::delete('/comment/{posting_id}/{id}', [CommentController::class, 'commentDestroy'])->name('comment.destroy');

    // Like & Unlike
    Route::post('/like', [LikeController::class, 'like'])->name('like');
    Route::post('/unlike', [LikeController::class, 'unlike'])->name('unlike');

    // fitur follow
    Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile-edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile-edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
