<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingsController extends Controller
{
    /**
     * Save notification preferences.
     */
    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        $user->notif_orders   = $request->boolean('notif_orders');
        $user->notif_promos   = $request->boolean('notif_promos');
        $user->notif_blog     = $request->boolean('notif_blog');
        $user->notif_security = $request->boolean('notif_security');
        $user->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Notification preferences saved.',
            ]);
        }

        return redirect('/dashboard#notifications')->with('status', 'notifications-updated');
    }

    /**
     * Save display / language / currency settings.
     */
    public function updateDisplay(Request $request)
    {
        $validated = $request->validate([
            'language' => ['required', 'string', 'max:100'],
            'currency' => ['required', 'string', 'max:100'],
        ]);

        Auth::user()->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Display preferences saved.',
            ]);
        }

        return redirect('/dashboard#settings')->with('status', 'display-updated');
    }

    /**
     * Save shipping address.
     */
    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'address_street' => ['nullable', 'string', 'max:255'],
            'address_city'   => ['nullable', 'string', 'max:100'],
            'address_region' => ['nullable', 'string', 'max:100'],
            'phone'          => ['nullable', 'string', 'max:30'],
        ]);

        Auth::user()->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Shipping address saved.',
            ]);
        }

        return redirect('/dashboard#settings')->with('status', 'address-updated');
    }
}
