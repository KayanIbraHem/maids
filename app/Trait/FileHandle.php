<?php

namespace App\Trait;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Model;

trait FileHandle
{
    public function prepareImage(array $data, ?Model $model = null): ?string
    {
        return  array_key_exists($this->imageKey, $data)
            ? imageHandle($data, $this->imageKey, $model, strtolower(class_basename($this->model)))
            : null;
    }
    public function prepareFile(array $data, ?Model $model = null): ?string
    {
        return  array_key_exists($this->fileKey, $data)
            ? fileHandle($data, $this->fileKey, $model, strtolower(class_basename($this->model)))
            : null;
    }
    public function removeImage($row): void
    {
        $image = hasImage($row, $this->imageKey);
        if ($image) deleteImage($image);
    }
    public function removeFile($row): void
    {
        $file = hasFile($row, $this->fileKey);
        if ($file) deleteFile($file);
    }
}
