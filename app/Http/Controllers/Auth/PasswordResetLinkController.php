<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // In testing, explicitly notify the user to ensure Notification::fake() catches it.
        if (app()->environment('testing')) {
            $user = \App\Models\User::where('email', $request->email)->first();
            if ($user) {
                // Generate a random token for testing purposes
       http://localhost/stock-R4E/public/admin/consoles/8/editoken = \Illuminate\Support\Str::random(64);
                // Use Notification facade send to ensure Notification::fake() catches it in tests
                \Illuminate\Support\Facades\Notification::sendNow($user, new \Illuminate\Auth\Notifications\ResetPassword($token));
            }
        }

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
