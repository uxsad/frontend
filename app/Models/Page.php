<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
