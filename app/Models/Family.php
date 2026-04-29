<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number', 'parent_name', 'email', 'phone', 'address',
        'suburb', 'postcode', 'state', 'children_count', 'children_ages',
        'care_type', 'days_required', 'preferred_start_date',
        'cultural_preferences', 'wait_time', 'privacy_consent', 'status',
    ];

    protected $casts = [
        'children_ages'        => 'array',
        'days_required'        => 'array',
        'privacy_consent'      => 'boolean',
        'preferred_start_date' => 'date',
    ];

    public function matches()
    {
        return $this->hasMany(CareMatch::class);
    }

    public static function generateReference(): string
    {
        do {
            $ref = 'FCN-F-' . strtoupper(substr(md5(uniqid()), 0, 6));
        } while (self::where('reference_number', $ref)->exists());
        return $ref;
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'matched'    => 'success',
            'waitlisted' => 'danger',
            default      => 'warning',
        };
    }
}