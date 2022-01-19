<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GooApiService
{
    /**
     * 漢字・カタカナを含む文字を平仮名に変換するメソッド
     * 
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
        } catch (\Exception $e) {
            Log::debug('gooapiでエラーが発生しました');
            Log::debug($e->getMessage());
            return '';
        }
    }

    /**
     * 形態素解析をして名詞の配列を返すメソッド
     * 
     * @param string|null $text 解析するテキスト
     * 
     * @return array
     */
    public static function morph(?string $text): array
    {
        if (!$text) {
            return [];
        }
        try {
            $response = Http::post(
                'https://labs.goo.ne.jp/api/morph',
                [
                    'app_id' => env('GOO_API_APP_ID'), // goo apiのAPP ID
                    'pos_filter' => '名詞', // 探す品詞
                    'sentence' => $text, // 解析するテキスト
                ]
            );
            $res = [];
            foreach ($response->json()['word_list'][0] as $data) {
                $res[] = $data[0];
            }
            return $res;
        } catch (\Exception $e) {
            return [];
        }
    }
}
