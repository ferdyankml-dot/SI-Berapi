<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Volcano extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'province',
        'height',
        'status_level',
        'latitude',
        'longitude',
        'description',
        'safety_radius',
        'image',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'height' => 'integer',
    ];

    public function missingPersons(): HasMany
    {
        return $this->hasMany(MissingPerson::class);
    }

    public function disasterHistories(): HasMany
    {
        return $this->hasMany(DisasterHistory::class)->orderBy('event_date', 'desc');
    }

    public function getStatusBadgeAttribute(): array
    {
        return match ($this->status_level) {
            'Awas' => [
                'bg' => 'bg-red-50',
                'border' => 'border-red-200',
                'text' => 'text-red-700',
                'badge' => 'bg-red-50 text-red-700 border border-red-200',
                'dot' => 'bg-red-600',
                'color' => '#DC2626',
                'level' => 4,
                'label' => 'Level IV (Awas)'
            ],
            'Siaga' => [
                'bg' => 'bg-orange-50',
                'border' => 'border-orange-200',
                'text' => 'text-orange-700',
                'badge' => 'bg-orange-50 text-orange-700 border border-orange-200',
                'dot' => 'bg-orange-600',
                'color' => '#EA580C',
                'level' => 3,
                'label' => 'Level III (Siaga)'
            ],
            'Waspada' => [
                'bg' => 'bg-amber-50',
                'border' => 'border-amber-200',
                'text' => 'text-amber-700',
                'badge' => 'bg-amber-50 text-amber-700 border border-amber-200',
                'dot' => 'bg-amber-500',
                'color' => '#D97706',
                'level' => 2,
                'label' => 'Level II (Waspada)'
            ],
            default => [
                'bg' => 'bg-emerald-50',
                'border' => 'border-emerald-200',
                'text' => 'text-emerald-700',
                'badge' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                'dot' => 'bg-emerald-600',
                'color' => '#059669',
                'level' => 1,
                'label' => 'Level I (Normal)'
            ],
        };
    }
}
