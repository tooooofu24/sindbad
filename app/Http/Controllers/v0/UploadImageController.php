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
        $image = $request->file('image');
        $image_path = Storage::disk('s3')->put('/test', $image, 'public');
        $url = env('AWS_BASE_URL') . $image_path;
        return $url;
    }
}
