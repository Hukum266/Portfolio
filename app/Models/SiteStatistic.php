<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteStatistic extends Model
{
    protected $fillable = ['label', 'value', 'suffix', 'icon', 'sort_order', 'is_active'];
}
