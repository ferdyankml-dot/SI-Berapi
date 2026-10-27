<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisasterHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'volcano_id',
        'event_date',
        'description',
        'impact_summary',
        'casualties_count',
        'image',
    ];

    protected $casts = [
        'event_date' => 'date',
        'casualties_count' => 'integer',
    ];

    public function volcano(): BelongsTo
    {
        return $this->belongsTo(Volcano::class);
    }
}
