<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'images';
    public function scopeSearch(Builder $builder): Builder
    {
        return $builder;
    }
}
