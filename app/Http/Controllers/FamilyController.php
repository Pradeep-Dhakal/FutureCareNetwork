<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function create()
    {
        return view('public.family-register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_name'       => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone'             => 'nullable|string|max:20',
            'address'           => 'nullable|string|max:500',
            'suburb'            => 'required|string|max:100',
            'postcode'          => 'required|string|max:10',
            'state'             => 'required|string|max:10',
            'children_count'    => 'required|integer|min:1|max:10',
            'children_ages'     => 'nullable|array',
            'children_ages.*'   => 'string',
            'care_type'         => 'required|string',
            'days_required'     => 'nullable|array',
            'days_required.*'   => 'string',
            'preferred_start_date' => 'nullable|date',
            'cultural_preferences' => 'nullable|string|max:500',
            'wait_time'         => 'nullable|string|max:100',
            'privacy_consent'   => 'required|accepted',
        ], [
            'privacy_consent.accepted' => 'You must accept the privacy consent to register.',
        ]);

        $validated['reference_number'] = Family::generateReference();
        $validated['privacy_consent']  = true;
        $validated['status']           = 'pending';

        $family = Family::create($validated);

        return redirect()->route('family.register')
            ->with('success', true)
            ->with('reference', $family->reference_number);
    }
}
