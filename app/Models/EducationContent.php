<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'content',
        'video_url',
        'thumbnail',
    ];

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'definisi' => 'Definisi & Tipe Erupsi',
            'penyebab' => 'Penyebab Terjadinya Erupsi',
            'dampak' => 'Dampak Vulkanik',
            'mitigasi' => 'Panduan Mitigasi & Keselamatan',
            default => ucfirst($this->category),
        };
    }

    public function getYoutubeEmbedAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/', $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $this->video_url;
    }
}
