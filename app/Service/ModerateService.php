<?php

namespace App\Service;

use App\Consts\Consts;

class ModerateService
{
    /**
     * テキストにNGワードが含まれているかチェックするメソッド
     * 
     * @param string|null $text
     * 
     * @return bool
     */
    public static function moderate(?string $text): bool
    {
        $nouns = GooApiService::morph($text);
        foreach ($nouns as $word) {
            if (in_array($word, Consts::NG_WORDS)) {
                return false;
            }
        }
        return true;
    }
}
