<?php

namespace App\Models\Nationality;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalityTranslation extends Model
{
    use HasFactory;
    protected $table = 'nationality_translations';
    protected $guarded = [];
}
