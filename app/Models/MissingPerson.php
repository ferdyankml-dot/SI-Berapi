<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MissingPerson extends Model
{
    use HasFactory;

    protected $table = 'missing_persons';

    protected $fillable = [
        'reporter_name',
        'reporter_phone',
        'victim_name',
        'age',
        'gender',
        'photo',
        'characteristics',
        'volcano_id',
        'last_seen_location',
        'last_seen_date',
        'status',
        'notes',
        'is_approved',
    ];

    protected $casts = [
        'last_seen_date' => 'date',
        'is_approved' => 'boolean',
        'age' => 'integer',
    ];

    public function volcano(): BelongsTo
    {
        return $this->belongsTo(Volcano::class);
    }

    public function getFormattedPhoneAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->reporter_phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        return $phone;
    }
}
