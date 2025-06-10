<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany; // Import MorphMany

class NewsArticle extends Model
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
        'excerpt',
        'content',
        'image_path',
        'image_caption',
        'author_name',
        'publication_date',
        'is_featured',
    ];

    /**
     * Get all of the article's comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(NewsComment::class, 'commentable');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_date' => 'datetime',
        'is_featured' => 'boolean',
    ];
}
