<?php
namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
    // redirect
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // callback
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            // tìm user
            $user = User::where('provider_id', $socialUser->id)->first();

            if (!$user) {
                $user = User::where('email', $socialUser->email)->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $socialUser->name,
                        'email' => $socialUser->email,
                        'avatar' => $socialUser->avatar,
                        'provider' => $provider,
                        'provider_id' => $socialUser->id,
                        'student_id' => $socialUser->student_id ?? '23810310110',
                        'password' => bcrypt('123456')
                    ]);
                } else {
                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->id
                    ]);
                }
            }

            Auth::login($user);

            return redirect('/dashboard');

        } catch (Exception $e) {
            dd($e->getMessage());;
        }
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}