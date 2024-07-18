<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('user-login.profile-edit', [
            'title' => 'My Profile',
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());
        try {
            $user = $request->user();
            $user->fill($request->validated());
    
            // Cek jika ada gambar baru yang diupload
            if ($request->hasFile('profile_image')) {
                // Hapus gambar lama dari direktori 'profile-image'
                $oldImagePath = str_replace('storage', 'profile-image', $user->profile_image);
                if ($user->profile_image && Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
    
                // Simpan gambar baru dan update path di database
                $imageName = 'profile_image_' . time() . '.' . $request->profile_image->extension();
                $path = $request->profile_image->storeAs('profile-image', $imageName, 'public');
                $user->profile_image = $path;
            }
    
            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }
    
            $request->user()->save();
    
            return back()->with('success', 'Profile Berhasil Diubah!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengubah profile. Silakan coba lagi.');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Akun Telah di Hapus');
    }
}
