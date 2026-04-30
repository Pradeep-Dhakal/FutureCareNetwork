<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Educator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ── FAMILY LOGIN ──────────────────────────────────────────────────────
    public function familyLoginForm()
    {
        return view('public.family-login');
    }

    public function familyLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $family = Family::where('email', $request->email)->first();

        if (!$family || !Hash::check($request->password, $family->password)) {
            return back()->withErrors(['email' => 'Incorrect email or password.'])->onlyInput('email');
        }

        Auth::guard('family')->login($family, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->route('family.dashboard');
    }

    public function familyLogout(Request $request)
    {
        Auth::guard('family')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('family.login');
    }

    // ── EDUCATOR LOGIN ────────────────────────────────────────────────────
    public function educatorLoginForm()
    {
        return view('public.educator-login');
    }

    public function educatorLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $educator = Educator::where('email', $request->email)->first();

        if (!$educator || !Hash::check($request->password, $educator->password)) {
            return back()->withErrors(['email' => 'Incorrect email or password.'])->onlyInput('email');
        }

        Auth::guard('educator')->login($educator, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->route('educator.dashboard');
    }

    public function educatorLogout(Request $request)
    {
        Auth::guard('educator')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('educator.login');
    }

    // ── FAMILY DASHBOARD ──────────────────────────────────────────────────
    public function familyDashboard()
    {
        $family = Auth::guard('family')->user();
        return view('public.family-dashboard', compact('family'));
    }

    // ── EDUCATOR DASHBOARD ────────────────────────────────────────────────
    public function educatorDashboard()
    {
        $educator = Auth::guard('educator')->user();
        return view('public.educator-dashboard', compact('educator'));
    }
}