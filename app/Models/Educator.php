<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Educator extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number', 'name', 'email', 'phone', 'suburb', 'postcode',
        'state', 'qualification', 'blue_card_number', 'blue_card_expiry',
        'insurance_status', 'care_types', 'availability', 'max_children',
        'age_groups', 'training_needs', 'service_description',
        'privacy_consent', 'status',
    ];

    protected $casts = [
        'care_types'       => 'array',
        'availability'     => 'array',
        'training_needs'   => 'array',
        'privacy_consent'  => 'boolean',
        'blue_card_expiry' => 'date',
    ];

    public function matches()
    {
        return $this->hasMany(CareMatch::class);
    }

    public static function generateReference(): string
    {
        do {
            $ref = 'FCN-E-' . strtoupper(substr(md5(uniqid()), 0, 6));
        } while (self::where('reference_number', $ref)->exists());
        return $ref;
    }

    public function getBlueCardStatusAttribute(): string
    {
        if (!$this->blue_card_expiry) return 'missing';
        if ($this->blue_card_expiry->isPast()) return 'expired';
        if ($this->blue_card_expiry->diffInDays(now()) <= 30) return 'expiring';
        return 'valid';
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'verified', 'active' => 'success',
            'suspended'          => 'danger',
            default              => 'warning',
        };
    }
}