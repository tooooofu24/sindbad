<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Facades\Http;

class ConvertTextService
{
    /**
     * 漢字・カタカナを含む文字を平仮名に変換するメソッド
     * @param string $text 変換したい文字
     * 
     * @return string
     */
    public static function convert(string $text): string
    {
        try {
            $response = Http::post(
                'https://labs.goo.ne.jp/api/hiragana',
                [
                    'app_id' => env('GOO_API_APP_ID'), // goo apiのAPP ID
                    'output_type' => 'hiragana', // 変換する形式
                    'sentence' => $text, // 変換するテキスト
                ]
            );
            return $response->json()['converted'];
        } catch (Exception $e) {
            return '';
        }
    }
}
