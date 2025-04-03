<?php

namespace App\Services;

class ImagekitService
{
    public $imagePath;
    public $options = [];

    public static function make()
    {
        return new static;
    }

    public function forImage(string $imagePath)
    {
        if (is_null($imagePath)) {
            throw new \Exception("Image path is required");
        }

        $this->imagePath = $imagePath;
        return $this;
    }

    public function addTransformation(array $options = [])
    {
        $this->options = $options;
        return $this;
    }

    public function generateUrl()
    {
        $imageKit = new \ImageKit\ImageKit(
            config('laravel-fresh.imagekit_public_key'),
            config('laravel-fresh.imagekit_private_key'),
            config('laravel-fresh.imagekit_endpoint'),
        );

        return $imageKit->url([
            "path" => $this->imagePath,
            "transformation" => [
                array_merge(
                    [
                        "q" => 75
                    ],
                    $this->options
                )
            ]
        ]);
    }
}
