<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

function updateImage($request, string $name, Model $model, string $folder): ?string
{
    if (array_key_exists($name, $request)) {
        if ($request[$name] !== null) {
            if ($model && $model[$name]) {
                deleteImage($model[$name]);
            }
            return uploadImage($request, $name, $folder);
        }
    }
    return optional($model)->image;
}
function uploadImage($request, string $name, string $folder)
{
    if (array_key_exists($name, $request)) {
        if (!$request[$name]) {
            return;
        }
        $file = $request[$name];
        $path = 'uploads/' . $file->store($folder, [
            'disk' => 'uploads'
        ]);
    }
    return $path ?? null;
}
function uploadImages($request, string $name, string $folder)
{
    $paths = [];
    if (array_key_exists($name, $request)) {
        $files = is_array($request[$name]) ? $request[$name] : [$request[$name]];
        foreach ($files as $file) {
            if ($file) {
                $path = 'uploads/' . $file->store($folder, [
                    'disk' => 'uploads'
                ]);
                $paths[] = $path;
            }
        }
    }
    return $paths;
}
function deleteImage($path)
{
    if ($path != "uploads/default.jpg") {
        File::delete(public_path($path));
    }
}
function updatePdf($request, string $name, Model $model, string $folder)
{
    if (array_key_exists($name, $request)) {
        if ($request[$name] !== null) {
            if ($model && $model[$name]) {
                deletePdf($model[$name]);
            }
            return uploadPdf($request, $name, $folder);
        }
    }
    return optional($model)->cv;
}
function uploadPdf($request, string $name, string $folder)
{
    if (array_key_exists($name, $request)) {
        $pdf = $request[$name];
        $pdfName = time() . rand(1, 9999) . '.' . $pdf->getClientOriginalExtension();
        $path = $pdf->storeAs($folder, $pdfName, 'files');
        return 'files/' . $path;
    }
}
function getTranslation(string $field, ?string $language,  $resource)
{
    if ($language == null) {
        $language = 'en';
    }
    if (isset($resource)) {
        if ($resource->has('translations') && $resource->translations) {
            $translation = $resource->translations->where('locale', $language)->first();
            if ($translation) {
                return $translation->$field;
            } else {
                $fallbackTranslation = $resource->translations->where('locale', '!=', $language)->first();
                if ($fallbackTranslation) {
                    return $fallbackTranslation->$field;
                }
                return $resource->translations->where('locale', 'en')->first()->$field ?? null;
            }
        }
    }
    return null;
}
function getTranslationAndLocale(Collection $translations, string $field): array
{
    $titles = [];
    foreach ($translations as $translation) {
        $titles[] = [
            'locale' => $translation?->locale ?? "",
            $field => $translation?->$field ?? "",
        ];
    }

    return $titles;
}
function reflectionClass(string $namespace): object
{
    $reflection = new ReflectionClass($namespace);
    return $reflection->newInstance();
}
function deletePdf($path)
{
    File::delete(public_path($path));
}
function isPDF($file): bool
{
    return $file->getMimeType() === 'application/pdf';
}

function isImage($file): bool
{
    return in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif']);
}
function hasImage($row, string $image): ?string
{
    return isset($row[$image]) ? $row[$image] : null;
}
function hasFile($row, string $file): ?string
{
    return isset($row[$file]) ? $row[$file] : null;
}
function hashUserPassword($password)
{
    return Hash::make($password);
}
function hashApiToken()
{
    return Hash::make(rand(99, 99999999));
}
function userApiToken(Model $model, string $name)
{
    return $model->createToken($name)->plainTextToken;
}
