<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $guarded = [];
}
