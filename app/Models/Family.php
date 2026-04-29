<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FamilyMatch;
use App\Models\Carematch;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'parent_name',
        'email',
        'phone',
        'address',
        'suburb',
        'postcode',
        'state',
        'children_count',
        'children_ages',
        'care_type',
        'days_required',
        'preferred_start_date',
        'cultural_preferences',
        'wait_time',
        'privacy_consent',
        'status',
    ];

    protected $casts = [
        'children_ages' => 'array',
        'days_required' => 'array',
        'privacy_consent' => 'boolean',
        'preferred_start_date' => 'date',
    ];



    public function matches()
    {
        return $this->hasMany(Carematch::class);
}
}