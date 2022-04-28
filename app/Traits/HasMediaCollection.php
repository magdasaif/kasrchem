<?php


namespace App\Models\Concerns;

use Spatie\Image\Manipulations;

trait HasMultipleImages
{
    public function hasMediaCollectionMultipleImages()
    {
        $this->addMediaCollection('images')
            ->registerMediaConversions(function () {
                $conversion = $this->addMediaConversion('resized')
                    ->fit(Manipulations::FIT_FILL, 720, 480)
                    ->background('white');
            });
    }
}
?>