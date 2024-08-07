<?php

namespace App\Models\Term;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory, Translatable;
    protected $table = 'terms';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'term_id';
    public function scopeSearch(Builder $builder): Builder
    {
        return $builder;
    }
}
