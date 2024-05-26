<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
    
    public function update(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'password'],
        'password' => ['required', 'confirmed', 'min:8', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
    ]);

    $user = $request->user();

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'Password updated successfully.']);
}

}
