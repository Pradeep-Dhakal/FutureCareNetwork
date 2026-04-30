<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FamilyController extends Controller
{
    public function create()
    {
        return view('public.family-register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent_name'          => 'required|string|max:255',
            'email'                => 'required|email|unique:families,email',
            'password'             => 'required|string|min:8|confirmed',
            'phone'                => 'nullable|string|max:20',
            'street_address'       => 'nullable|string|max:500',
            'suburb'               => 'required|string|max:100',
            'postcode'             => 'required|string|max:10',
            'state'                => 'required|string|max:10',
            'children_count'       => 'required|integer|min:1',
            'children_ages'        => 'nullable|array',
            'care_type'            => 'required|string',
            'days_required'        => 'nullable|array',
            'preferred_start_date' => 'nullable|date',
            'cultural_preferences' => 'nullable|string|max:500',
            'wait_time'            => 'nullable|string|max:100',
            'special_needs'        => 'nullable|string|max:1000',
            'privacy_consent'      => 'required|accepted',
        ], [
            'email.unique'             => 'This email is already registered. Please login instead.',
            'password.confirmed'       => 'Passwords do not match.',
            'password.min'             => 'Password must be at least 8 characters.',
            'privacy_consent.accepted' => 'You must accept the privacy consent to register.',
        ]);

        Family::create([
            'reference_number'     => Family::generateReference(),
            'parent_name'          => $request->parent_name,
            'email'                => $request->email,
            'password'             => Hash::make($request->password),
            'phone'                => $request->phone,
            'address'              => $request->street_address,
            'suburb'               => $request->suburb,
            'postcode'             => $request->postcode,
            'state'                => $request->state,
            'children_count'       => (int) $request->children_count,
            'children_ages'        => $request->children_ages ?? [],
            'care_type'            => $request->care_type,
            'days_required'        => $request->days_required ?? [],
            'preferred_start_date' => $request->preferred_start_date,
            'cultural_preferences' => $request->cultural_preferences,
            'wait_time'            => $request->wait_time,
            'privacy_consent'      => true,
            'status'               => 'pending',
        ]);

        return redirect()->route('family.success');
    }
}