<?php
namespace App\Manager;

use App\Models\User;
use Illuminate\Support\Facades\File;

class ImageManager{

    public const DEFAULT_IMAGE = 'images/default.webp';

    public static function uploadImage(string $name, string $path, string $image)
    {
        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            // Get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png','webp','avif'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }


        $type = '.'.$type;
        $absolutePath = public_path($path);
        $relativePath = $path . $name . $type;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        $image_file_name = $name.$type;

        return $image_file_name;
    }

    final public static function deletePhoto(string $path, string $img):void
    {
        $path = public_path($path).$img;
        if ($img != '' && file_exists($path )) {
            unlink($path);
        }
    }

    public static function prepareImageUrl(string $path, string|null $image)
    {
        //$url = 'https://api.etilib.com/'.$path.$image;

        $url = url($path.$image);
        if (empty($image)) {
            $url = url(self::DEFAULT_IMAGE);
        }
        return $url;
    }

    public static function processImageUpload(
        string $file,
        string $name,
        string $path,

        string $existing_photo = null
    )
    {

        if (!empty($existing_photo)) {
            self::deletePhoto($path, $existing_photo);
        }

        $photo_name = self::uploadImage($name, $path, $file);


        return $photo_name;

    }

}

