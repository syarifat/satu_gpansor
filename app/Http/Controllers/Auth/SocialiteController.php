<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialiteController extends Controller
{
    // 1. Redirect ke Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Callback dari Google
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            // SKENARIO A: User Benar-benar Baru
            if (!$user) {
                $user = User::create([
                    'nama' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => null, // Password null penanda profil belum lengkap
                    'role' => 'anggota',
                    'is_active' => false,
                ]);
            } else {
                // SKENARIO B: User Lama, Update Google ID jika belum ada
                if (empty($user->google_id)) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                }
            }

            // Login User tersebut
            Auth::login($user);

            // CEK STATUS PROFIL:
            // Jika password masih kosong, berarti dia baru daftar via Google 
            // dan belum mengisi biodata. Lempar ke halaman Complete Profile.
            if (is_null($user->password)) {
                return redirect()->route('complete.profile');
            }

            // Jika status belum aktif (menunggu admin)
            if ($user->is_active == 0) {
                Auth::logout(); // Logout biar tidak masuk dashboard
                return redirect()->route('login')
                    ->with('error', 'Akun Anda sedang dalam proses verifikasi Admin. Mohon tunggu.');
            }

            // Jika semua aman, masuk dashboard
            return redirect()->intended('dashboard');

        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }
}