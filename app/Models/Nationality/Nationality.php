<?php

namespace App\Models\Nationality;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nationality extends Model
{
    use HasFactory, Translatable;
    protected $table = 'nationalities';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'nationality_id';
}
