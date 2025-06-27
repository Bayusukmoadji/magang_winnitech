<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReplyLaunch extends Model
{
    use HasFactory;

    /**
     * Memberitahu Laravel untuk menggunakan tabel 'reply_launches'.
     */
    protected $table = 'reply_launches';

    /**
     * Kolom yang bisa diisi.
     */
    protected $fillable = [
        'launches_comment_id', // <-- Menyesuaikan dengan foreign key di migrasi
        'name',
        'comment',
    ];

    /**
     * Relasi: Balasan ini milik satu LaunchComment.
     */
    public function commentlaunch(): BelongsTo
    {
        // <-- Menyesuaikan dengan foreign key di migrasi
        return $this->belongsTo(LaunchComment::class, 'launches_comment_id');
    }
}
