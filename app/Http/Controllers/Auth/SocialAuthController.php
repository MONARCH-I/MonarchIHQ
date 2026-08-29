<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Whitelist of allowed providers and driver mappings
     */
    protected array $providerMap = [
        'google' => 'google',
        'microsoft' => 'azure',
        'azure' => 'azure',
    ];

    public function redirect(string $provider)
    {
        if (! isset($this->providerMap[$provider])) {
            return redirect('/login')->withErrors([
                'email' => "Authentication provider [{$provider}] is not supported.",
            ]);
        }

        $driver = $this->providerMap[$provider];

        return Socialite::driver($driver)->redirect();
    }

    public function callback(Request $request, string $provider)
    {
        if (! isset($this->providerMap[$provider])) {
            return redirect('/login')->withErrors([
                'email' => "Authentication provider [{$provider}] is not supported.",
            ]);
        }

        $driver = $this->providerMap[$provider];

        try {
            $socialUser = Socialite::driver($driver)->user();

            $email = $socialUser->getEmail()
                ?? ($socialUser->user['userPrincipalName'] ?? null)
                ?? ($socialUser->user['mail'] ?? null);

            if (! $email) {
                return redirect('/login')->withErrors([
                    'email' => "Could not retrieve an email address from {$provider}. Please ensure your account has a verified email address.",
                ]);
            }

            $user = User::where('email', $email)->first();

            if ($user) {
                $user->update([
                    'name' => $user->name ?: ($socialUser->getName() ?? $socialUser->getNickname() ?? 'User'),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                    'email_verified_at' => $user->email_verified_at ?? now(),
                ]);
            } else {
                $user = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? explode('@', $email)[0] ?? 'User',
                    'email' => $email,
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                    'email_verified_at' => now(),
                ]);
            }

            Auth::login($user, true);
            $request->session()->regenerate();

            // Clear any stale intended URL that pointed to login or verification notices
            $intended = session()->get('url.intended');
            if ($intended && (str_contains($intended, 'login') || str_contains($intended, 'verify-email') || str_contains($intended, 'register'))) {
                session()->forget('url.intended');
            }

            return redirect()->intended(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            Log::error("SSO Callback Error for [{$provider}]: ".$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect('/login')->withErrors([
                'email' => 'Unable to login with '.ucfirst($provider).': '.$e->getMessage(),
            ]);
        }
    }
}
