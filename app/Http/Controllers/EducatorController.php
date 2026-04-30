<?php

namespace App\Http\Controllers;

use App\Models\Educator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EducatorController extends Controller
{
    public function create()
    {
        return view('public.educator-register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|unique:educators,email',
            'password'            => 'required|string|min:8|confirmed',
            'phone'               => 'nullable|string|max:20',
            'suburb'              => 'required|string|max:100',
            'postcode'            => 'required|string|max:10',
            'state'               => 'required|string|max:10',
            'qualification'       => 'required|string|max:255',
            'blue_card_number'    => 'nullable|string|max:50',
            'blue_card_expiry'    => 'nullable|date',
            'insurance_status'    => 'required|in:valid,pending,none',
            'care_types'          => 'nullable|array',
            'availability'        => 'nullable|array',
            'max_children'        => 'required|integer|min:1|max:10',
            'age_groups'          => 'nullable|string|max:255',
            'training_needs'      => 'nullable|array',
            'service_description' => 'nullable|string|max:1000',
            'privacy_consent'     => 'required|accepted',
        ], [
            'email.unique'             => 'This email is already registered. Please login instead.',
            'password.confirmed'       => 'Passwords do not match.',
            'password.min'             => 'Password must be at least 8 characters.',
            'privacy_consent.accepted' => 'You must accept the privacy consent to register.',
        ]);

        Educator::create([
            'reference_number'    => Educator::generateReference(),
            'name'                => $request->name,
            'email'               => $request->email,
            'password'            => Hash::make($request->password),
            'phone'               => $request->phone,
            'suburb'              => $request->suburb,
            'postcode'            => $request->postcode,
            'state'               => $request->state,
            'qualification'       => $request->qualification,
            'blue_card_number'    => $request->blue_card_number,
            'blue_card_expiry'    => $request->blue_card_expiry,
            'insurance_status'    => $request->insurance_status,
            'care_types'          => $request->care_types ?? [],
            'availability'        => $request->availability ?? [],
            'max_children'        => (int) $request->max_children,
            'age_groups'          => $request->age_groups,
            'training_needs'      => $request->training_needs ?? [],
            'service_description' => $request->service_description,
            'privacy_consent'     => true,
            'status'              => 'pending',
        ]);

        return redirect()->route('educator.success');
    }
}