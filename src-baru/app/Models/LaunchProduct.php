<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany; // Import MorphMany

class LaunchProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'company_name',
        'launch_date',
        'image_path',
        'short_description',
        'long_description',
        'key_features',
        'technical_specifications',
        'official_site_url',
    ];

    /**
     * Get all of the launch product's comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(LaunchComment::class, 'commentable');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'launch_date' => 'date', // Atau 'datetime' jika Anda menyimpan waktu juga
        'key_features' => 'array', // Mengonversi JSON ke array PHP dan sebaliknya
        'technical_specifications' => 'array', // Mengonversi JSON ke array PHP dan sebaliknya
    ];
}
