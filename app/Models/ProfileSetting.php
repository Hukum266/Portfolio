<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileSetting extends Model
{
    protected $fillable = [
        'full_name', 'professional_title', 'short_bio', 'biography',
        'profile_image', 'hero_image', 'email', 'phone', 'location',
        'website', 'cv_file', 'site_title', 'meta_description',
        'logo', 'favicon', 'accent_color', 'hero_intro', 'hero_heading', 'hero_description',
    ];

    /**
     * Get the single profile settings record (or create defaults).
     */
    public static function getSingleton(): self
    {
        return self::firstOrCreate([], [
            'full_name'          => 'Hukum Roka',
            'professional_title' => 'Web Developer | Graphics Designer',
            'short_bio'          => 'I build modern, responsive web experiences.',
            'hero_intro'         => "HI I'M A FREELANCER",
            'hero_heading'       => 'Web Developer',
            'accent_color'       => '#22c55e',
        ]);
    }
}
