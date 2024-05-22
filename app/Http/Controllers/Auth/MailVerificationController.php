<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MailVerificationController extends Controller
{
    /**
     * Verify the user's email address.
     *
     * @param  Request  $request
     * @param  int  $id
     * @param  string  $hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request, $id, $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Check if the hash matches the user's email verification hash
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect('/login')->with('error', 'Invalid verification link.');
        }

        // Check if the user is already verified
        if ($user->hasVerifiedEmail()) {
            return redirect('/login')->with('error', 'Email address already verified.');
        }

        // Mark the user's email as verified and update status
        $user->markEmailAsVerified();
        $user->status = 'active';
        $user->save();

        event(new Verified($user));

        return redirect()->route('auth.login')->with('success', 'Email address verified. Your account is now active.');
    }
}
