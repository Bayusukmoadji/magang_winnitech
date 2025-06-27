<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaunchComment extends Model
{
    use HasFactory;

    /**
     * Memberitahu Laravel untuk menggunakan tabel 'launches_comments'.
     */
    protected $table = 'launches_comments';

    /**
     * Kolom yang bisa diisi.
     */
    protected $fillable = [
        'launch_product_id',
        'name',
        'comment',
    ];

    /**
     * Relasi: Komentar ini milik satu LaunchProduct.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(LaunchProduct::class, 'launch_product_id');
    }

    /**
     * Relasi: Komentar ini memiliki banyak balasan.
     */
    public function replies(): HasMany
    {
        // Menunjuk ke model ReplyLaunch dengan foreign key yang benar
        return $this->hasMany(ReplyLaunch::class, 'launches_comment_id');
    }
}
