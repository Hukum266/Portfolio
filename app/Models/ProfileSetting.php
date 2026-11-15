<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProfileSetting extends Model
{
    protected $fillable = [
        'full_name', 'professional_title', 'short_bio', 'biography',
        'profile_image', 'hero_image', 'email', 'phone', 'location',
        'website', 'cv_file', 'site_title', 'meta_description',
        'logo', 'favicon', 'accent_color', 'hero_intro', 'hero_heading', 'hero_description',
    ];

    /** Full public URL for the profile image, or null. */
    public function profileImageUrl(): ?string
    {
        return $this->profile_image
            ? Storage::disk('public')->url($this->profile_image)
            : null;
    }

    /** Full public URL for the hero image, or null. */
    public function heroImageUrl(): ?string
    {
        return $this->hero_image
            ? Storage::disk('public')->url($this->hero_image)
            : null;
    }

    /** Full public URL for the logo, or null. */
    public function logoUrl(): ?string
    {
        return $this->logo
            ? Storage::disk('public')->url($this->logo)
            : null;
    }

    /** Full public URL for the favicon, or null. */
    public function faviconUrl(): ?string
    {
        return $this->favicon
            ? Storage::disk('public')->url($this->favicon)
            : null;
    }

    /** Full public URL for the CV file, or null. */
    public function cvUrl(): ?string
    {
        return $this->cv_file
            ? Storage::disk('public')->url($this->cv_file)
            : null;
    }

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
