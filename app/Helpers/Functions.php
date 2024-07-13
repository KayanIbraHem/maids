<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


function uploadImage(Request $request, string $name, string $folder)
{
    if (!$request->hasFile($name)) {
        return;
    }
    $file = $request->file($name);
    $path = 'uploads/' . $file->store($folder, [
        'disk' => 'uploads'
    ]);
    return $path;
}
function updateImage(Request $request, Model $model, string $name, string $folder): ?string
{
    if ($request->image !== null) {
        if ($model && $model->image) {
            deleteImage($model->image);
        }
        return uploadImage($request, $name, $folder);
    }
    return optional($model)->image;
}

function deleteImage($path)
{
    if ($path != "uploads/default.jpg") {
        File::delete(public_path($path));
    }
}

function hashUserPassword($password)
{
    return Hash::make($password);
}
function hashApiToken()
{
    return Hash::make(rand(99, 99999999));
}
