<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

function updateImage($request, Model $model, string $folder): ?string
{
    if (array_key_exists('image', $request)) {
        if ($request['image'] !== null) {
            if ($model && $model['image']) {
                deleteImage($model['image']);
            }
            return uploadImage($request, 'image', $folder);
        }
    }
    return optional($model)->image;
}
function uploadImage($request, string $name, string $folder)
{
    if (array_key_exists('image', $request)) {
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
function deleteImage($path)
{
    if ($path != "uploads/default.jpg") {
        File::delete(public_path($path));
    }
}
function updatePdf($request, Model $model, string $folder)
{
    if (array_key_exists('cv', $request)) {
        if ($request['cv'] !== null) {
            if ($model && $model['cv']) {
                deletePdf($model['cv']);
            }
            return uploadPdf($request, $folder);
        }
    }
    return optional($model)->cv;
}
function uploadPdf($request, string $folder)
{
    if (array_key_exists('cv', $request)) {
        $pdf = $request['cv'];
        $pdfName = time() . rand(1, 9999) . '.' . $pdf->getClientOriginalExtension();
        $path = $pdf->storeAs($folder, $pdfName, 'files');
        return 'files/' . $path;
    }
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
function hashUserPassword($password)
{
    return Hash::make($password);
}
function hashApiToken()
{
    return Hash::make(rand(99, 99999999));
}
