<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Educator;
use App\Models\Carematch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $totalFamilies   = Family::count();
        $totalEducators  = Educator::count();
        $totalMatches    = Carematch::where('status', 'confirmed')->count();
        $totalWaitlisted = Family::where('status', 'waitlisted')->count();

        // Monthly registrations for last 6 months
        $months = collect(range(5, 0))->map(function ($i) {
            $date = Carbon::now()->subMonths($i);
            return [
                'label'     => $date->format('M'),
                'families'  => Family::whereYear('created_at', $date->year)
                                     ->whereMonth('created_at', $date->month)->count(),
                'educators' => Educator::whereYear('created_at', $date->year)
                                       ->whereMonth('created_at', $date->month)->count(),
            ];
        });

        // Care type demand
        $careTypes = Family::selectRaw('care_type, COUNT(*) as count')
            ->groupBy('care_type')
            ->pluck('count', 'care_type');

        // Regional demand by postcode
        $regional = Family::selectRaw('postcode, suburb, COUNT(*) as count')
            ->groupBy('postcode', 'suburb')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalFamilies', 'totalEducators', 'totalMatches', 'totalWaitlisted',
            'months', 'careTypes', 'regional'
        ));
    }

    public function families(Request $request)
    {
        $query = Family::query();
        if ($request->filled('search')) {
            $query->where('parent_name', 'like', '%' . $request->search . '%')
                  ->orWhere('suburb', 'like', '%' . $request->search . '%')
                  ->orWhere('reference_number', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $families = $query->latest()->paginate(15);
        return view('admin.families', compact('families'));
    }

    public function educators(Request $request)
    {
        $query = Educator::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('suburb', 'like', '%' . $request->search . '%')
                  ->orWhere('reference_number', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $educators = $query->latest()->paginate(15);
        return view('admin.educators', compact('educators'));
    }

    public function matches()
    {
        $matches = Carematch::with(['family', 'educator'])->latest()->paginate(15);
        return view('admin.matches', compact('matches'));
    }

    public function updateFamilyStatus(Request $request, Family $family)
    {
        $family->update(['status' => $request->status]);
        return back()->with('toast', 'Family status updated.');
    }

    public function updateEducatorStatus(Request $request, Educator $educator)
    {
        $educator->update(['status' => $request->status]);
        return back()->with('toast', 'Educator status updated.');
    }

    public function deleteFamily(Family $family)
    {
        $family->delete();
        return back()->with('toast', 'Family record deleted.');
    }

    public function deleteEducator(Educator $educator)
    {
        $educator->delete();
        return back()->with('toast', 'Educator record deleted.');
    }
}
