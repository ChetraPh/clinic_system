<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showSetupForm(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        if (!empty($user->google2fa_secret)) {
            return redirect()->route('2fa.verify');
        }

        $google2fa = new Google2FA();

        $secret = $request->session()->get('2fa_temp_secret');

        if (!$secret || strlen($secret) < 16) {
            $secret = $google2fa->generateSecretKey(32);
            $request->session()->put('2fa_temp_secret', $secret);
        }

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name', 'Prum Santepheap'),
            $user->email,
            $secret
        );

        $renderer = new ImageRenderer(
            new RendererStyle(220),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);

        $qrCodeSvg = $writer->writeString($qrCodeUrl);

        $qrCodeSvg = preg_replace(
            '/^<\?xml.*?\?>/',
            '',
            $qrCodeSvg
        );

        return view('auth.2fa.setup', [
            'qrCodeSvg' => $qrCodeSvg,
            'secret' => $secret,
        ]);
    }

    public function confirmSetup(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|digits:6',
        ]);

        $secret = $request->session()->get('2fa_temp_secret');

        if (!$secret || strlen($secret) < 16) {

            $request->session()->forget('2fa_temp_secret');

            return redirect()
                ->route('2fa.setup')
                ->with(
                    'error',
                    '2FA session expired. Please scan the QR code again.'
                );
        }

        $google2fa = new Google2FA();

        if (!$google2fa->verifyKey(
            $secret,
            $request->one_time_password
        )) {
            return back()->with(
                'error',
                __('auth2fa.invalid_code')
            );
        }

        $user = User::findOrFail(Auth::id());

        $user->google2fa_secret = $secret;
        $user->google2fa_enabled = true;
        $user->save();

        $request->session()->forget('2fa_temp_secret');
        $request->session()->put('2fa_passed', true);

        $intended = $request->session()->pull(
            '2fa_intended',
            RouteServiceProvider::HOME
        );

        return redirect($intended);
    }

    public function showVerifyForm(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        if (empty($user->google2fa_secret)) {

            $request->session()->forget('2fa_passed');

            return redirect()->route('2fa.setup');
        }

        return view('auth.2fa.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|digits:6',
        ]);

        $user = User::findOrFail(Auth::id());

        $secret = $user->google2fa_secret;

        if (empty($secret) || strlen($secret) < 16) {

            $user->google2fa_secret = null;
            $user->google2fa_enabled = false;
            $user->save();

            $request->session()->forget('2fa_temp_secret');
            $request->session()->forget('2fa_passed');

            return redirect()
                ->route('2fa.setup')
                ->with(
                    'error',
                    'Your 2FA secret is invalid. Please set up 2FA again.'
                );
        }

        $google2fa = new Google2FA();

        if (!$google2fa->verifyKey(
            $secret,
            $request->one_time_password
        )) {
            return back()->with(
                'error',
                __('auth2fa.invalid_code')
            );
        }

        $request->session()->put('2fa_passed', true);
        $request->session()->regenerate();

        $intended = $request->session()->pull(
            '2fa_intended',
            RouteServiceProvider::HOME
        );

        return redirect($intended);
    }
}