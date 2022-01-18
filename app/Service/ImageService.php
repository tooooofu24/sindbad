<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    protected $image;
    function __construct($image)
    {
        $post_max_size = 2000000; // 2M
        if ($image->getSize() > $post_max_size) {
            // 2Mを超えていた場合はファイルを小さくする
            $image = \InterventionImage::make($image)->resize(1080, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image = \InterventionImage::make($image);
        }
        $this->image = $image;
    }

    /**
     * {$folder}/{$name}.pngでs3に保存される
     * @param string $folder
     * @param string $name
     * 
     * @return string
     */
    public function save(string $folder, string $name): string
    {
        $resource = $this->image->stream()->detach();
        $file_path = "develop/$folder/$name.png";
        Storage::disk('s3')->put(
            $file_path,
            $resource,
            'public'
        );
        return env('AWS_BASE_URL') . $file_path;
    }
}
