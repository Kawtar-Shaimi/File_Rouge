<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageHelper
{
    /**
     * Upload and resize an image
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $folder
     * @param int $width
     * @param int $height
     * @return string
     */
    public static function uploadImage($image, $folder = 'images', $width = 800, $height = 800)
    {
        // Generate a unique filename
        $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();

        // Create the folder if it doesn't exist
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        // Resize and save the image
        $img = Image::make($image->getRealPath());
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Save the image
        $img->save(storage_path('app/public/' . $folder . '/' . $filename));

        return $folder . '/' . $filename;
    }

    /**
     * Delete an image
     *
     * @param string $path
     * @return bool
     */
    public static function deleteImage($path)
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }

    /**
     * Get the full URL for an image
     *
     * @param string $path
     * @return string
     */
    public static function getImageUrl($path)
    {
        if (!$path) {
            return null;
        }
        return Storage::disk('public')->url($path);
    }

    /**
     * Get the full URL for a book image
     *
     * @param string $path
     * @return string
     */
    public static function getBookImageUrl($path)
    {
        if (!$path) {
            return asset('images/default-book.jpg');
        }

        // Vérifier si le chemin commence par 'storage/'
        if (strpos($path, 'storage/') === 0) {
            return asset($path);
        }

        // Sinon, ajouter 'storage/' au début du chemin
        return asset('storage/' . $path);
    }

    /**
     * Check if an image exists
     *
     * @param string $path
     * @return bool
     */
    public static function imageExists($path)
    {
        return Storage::disk('public')->exists($path);
    }
} 