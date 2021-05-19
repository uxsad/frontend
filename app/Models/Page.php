<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Browsershot\Browsershot;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'website_id', 'title'];

    public function website(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function emotions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Emotion::class);
    }

    public function getScreenshotAttribute(): string
    {
        return Browsershot::url($this->url)
            ->noSandbox()
            ->windowSize(1920, 1080)
            ->fullPage()
            ->screenshot();
    }

    public function getBase64ScreenshotAttribute(): string
    {
        return "data:image/png;base64," . base64_encode($this->getScreenshotAttribute());
    }
}
