<?php

namespace App\Http\Controllers;

use App\Models\Educator;
use Illuminate\Http\Request;

class EducatorController extends Controller
{
    public function create()
    {
        return view('public.educator-register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone'             => 'nullable|string|max:20',
            'suburb'            => 'required|string|max:100',
            'postcode'          => 'required|string|max:10',
            'state'             => 'required|string|max:10',
            'qualification'     => 'required|string|max:255',
            'blue_card_number'  => 'nullable|string|max:50',
            'blue_card_expiry'  => 'nullable|date',
            'insurance_status'  => 'required|in:valid,pending,none',
            'care_types'        => 'nullable|array',
            'care_types.*'      => 'string',
            'availability'      => 'nullable|array',
            'availability.*'    => 'string',
            'max_children'      => 'required|integer|min:1|max:10',
            'age_groups'        => 'nullable|string|max:255',
            'training_needs'    => 'nullable|array',
            'training_needs.*'  => 'string',
            'service_description' => 'nullable|string|max:1000',
            'privacy_consent'   => 'required|accepted',
        ], [
            'privacy_consent.accepted' => 'You must accept the privacy consent to register.',
        ]);

        $validated['reference_number'] = Educator::generateReference();
        $validated['privacy_consent']  = true;
        $validated['status']           = 'pending';

        $educator = Educator::create($validated);

        return redirect()->route('educator.register')
            ->with('success', true)
            ->with('reference', $educator->reference_number);
    }
}
