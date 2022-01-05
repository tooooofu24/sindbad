<?php

namespace App\Http\Controllers\v0;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadImageController extends Controller
{
    public function __invoke(Request $request)
    {
        //  ↓バイナリアップロード
        // $file_base64 = $request->image;

        // // Base64文字列をデコードしてバイナリに変換
        // list(, $fileData) = explode(';', $file_base64);
        // list(, $fileData) = explode(',', $fileData);
        // $fileData = base64_decode($fileData);

        // // ファイルの名前
        // $fileName = 'test/' . Str::random(40) . '.png';

        // // AWS S3 に保存する
        // Storage::disk('s3')->put($fileName, $fileData, 'public');

        // return env('AWS_BASE_URL') . $fileName;

        $image = $request->file('image');
        $image_path = Storage::disk('s3')->put('/test', $image, 'public');
        $url = env('AWS_BASE_URL') . $image_path;
        return $url;
    }
}
