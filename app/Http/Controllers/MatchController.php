<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Educator;
use App\Models\Match;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Run basic matching algorithm:
     * Match families with educators based on postcode, care type, availability.
     */
    public function runMatching()
    {
        $pendingFamilies = Family::where('status', 'pending')->get();
        $matched = 0;

        foreach ($pendingFamilies as $family) {
            // Find educators in same postcode with matching care type
            $educators = Educator::where('postcode', $family->postcode)
                ->where('status', 'verified')
                ->get()
                ->filter(function ($educator) use ($family) {
                    $careTypes = $educator->care_types ?? [];
                    return in_array($family->care_type, $careTypes);
                });

            if ($educators->isNotEmpty()) {
                $educator = $educators->first();

                // Check no existing match
                $existing = Match::where('family_id', $family->id)
                    ->where('educator_id', $educator->id)
                    ->exists();

                if (!$existing) {
                    Match::create([
                        'family_id'   => $family->id,
                        'educator_id' => $educator->id,
                        'status'      => 'confirmed',
                        'notes'       => 'Auto-matched by system based on postcode and care type.',
                    ]);
                    $family->update(['status' => 'matched']);
                    $matched++;
                }
            } else {
                $family->update(['status' => 'waitlisted']);
            }
        }

        return back()->with('toast', "Matching complete. {$matched} new matches created.");
    }

    public function updateStatus(Request $request, Match $match)
    {
        $match->update(['status' => $request->status]);
        return back()->with('toast', 'Match status updated.');
    }

    public function destroy(Match $match)
    {
        $match->delete();
        return back()->with('toast', 'Match deleted.');
    }
}
