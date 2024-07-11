<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

function uploadImage($request, $name, $title)
{
    if (!$request->hasFile($name)) {
        return;
    }
    $file = $request->file($name);
    $path = 'uploads/' . $file->store($title, [
        'disk' => 'uploads'
    ]);
    return $path;
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
