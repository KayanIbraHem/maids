<?php

namespace App\Trait;

trait FileHandle
{
    public function prepareImage(array $data): ?string
    {
        return  array_key_exists($this->imageKey, $data)
            ? uploadImage($data, $this->imageKey, strtolower(class_basename($this->model)))
            : null;
    }
    public function prepareFile(array $data): ?string
    {
        return  array_key_exists($this->fileKey, $data)
            ? uploadPdf($data, $this->fileKey, strtolower(class_basename($this->model)))
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
        if ($file) deletePdf($file);
    }
}
