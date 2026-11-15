<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'title', 'issuer', 'issued_date', 'credential_url', 'image', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'is_active'   => 'boolean',
    ];
}
