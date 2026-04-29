<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carematch extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = [
        'family_id',
        'educator_id',
        'status',
        'notes'
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function educator()
    {
        return $this->belongsTo(Educator::class);
    }
}