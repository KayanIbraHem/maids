<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Policy extends Model
{
    use HasFactory, Translatable;
    protected $table = 'policies';
    protected $guarded = [];
    public $translatedAttributes = ['description'];
    protected $translationForeignKey = 'policy_id';
    public function scopeFilter(Builder $builder): Builder
    {
        return $builder;
    }
}
