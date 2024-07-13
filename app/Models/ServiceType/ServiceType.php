<?php

namespace App\Models\ServiceType;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceType extends Model
{
    use HasFactory, Translatable;
    protected $table = 'service_types';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'service_type_id';
}
