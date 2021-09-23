<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    public static function upload($imageFile, $folderName)
    {
        if (is_array($imageFile)) {
            $imageFile = $imageFile['image'];
        }
        // 画像のリサイズ処理
        $fileName = uniqid(rand() . '_');
        $extension = $imageFile->extension(); // 拡張子の取得
        $fileNameToStore = $fileName . '.' . $extension;
        $resizedImage = InterventionImage::make($imageFile)->resize(1920, 1080)->encode();

        Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage);
        return $fileNameToStore;
    }
}
