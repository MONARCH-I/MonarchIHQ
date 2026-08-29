<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ManagerAuthController extends Controller
{
    /**
     * Display the dedicated Manager & Staff login view.
     */
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            if (Auth::user()->hasManagerAccess()) {
                return redirect()->route('manager');
            }

            return redirect()->route('dashboard');
        }

        return view('manager.auth.login');
    }

    /**
     * Handle incoming manager authentication.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        /** @var User $user */
        $user = Auth::user();

        // Ensure user has manager access (super_admin, content_manager, store_manager, hr_manager)
        if (! $user->hasManagerAccess()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'Access denied. This account does not possess staff or manager privileges.',
            ]);
        }

        $request->session()->regenerate();

        // Redirect directly to the appropriate manager portal
        return redirect()->intended(route('manager'));
    }

    /**
     * Log the manager out of the session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('manager.login')->with('status', 'You have been securely signed out.');
    }
}
