<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'degree', 'institution', 'location', 'field_of_study',
        'start_year', 'end_year', 'is_current', 'description', 'sort_order',
    ];

    protected $casts = [
        'is_current' => 'boolean',
    ];

    public function getPeriodAttribute(): string
    {
        $end = $this->is_current ? 'Present' : ($this->end_year ?? '');
        return "{$this->start_year} – {$end}";
    }
}
