<?php

namespace App\Http\Traits;

trait CommentCensor
{
    /**
     * Menyensor teks berdasarkan daftar kata di file konfigurasi.
     *
     * @param string $text
     * @return string
     */
    protected function censorComment(string $text): string
    {
        // Ambil daftar kata dari file config/profanity.php
        $badWords = config('profanity.words', []);

        if (empty($badWords)) {
            return $text;
        }

        // Loop melalui setiap kata kotor
        foreach ($badWords as $word) {

            if (strlen($word) > 2) {
                $replacement = substr($word, 0, 1) . str_repeat('*', strlen($word) - 2) . substr($word, -1, 1);
            } else {
                $replacement = str_repeat('*', strlen($word));
            }


            $text = str_ireplace($word, $replacement, $text);
        }

        return $text;
    }
}
