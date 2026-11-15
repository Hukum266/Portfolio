<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_category_id', 'title', 'slug', 'description',
        'thumbnail', 'technologies', 'live_url', 'github_url',
        'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    public function getTechnologiesArrayAttribute(): array
    {
        return $this->technologies
            ? array_map('trim', explode(',', $this->technologies))
            : [];
    }

    /** Full public URL for the thumbnail, or null. */
    public function thumbnailUrl(): ?string
    {
        return $this->thumbnail
            ? Storage::disk('public')->url($this->thumbnail)
            : null;
    }
}
