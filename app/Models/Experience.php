<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experiences';

    protected $fillable = [
        'job_title', 'company', 'location',
        'start_date', 'end_date', 'is_current',
        'description', 'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_current' => 'boolean',
    ];

    public function getPeriodAttribute(): string
    {
        $start = $this->start_date?->format('M Y');
        $end   = $this->is_current ? 'Present' : $this->end_date?->format('M Y');
        return "{$start} – {$end}";
    }
}
