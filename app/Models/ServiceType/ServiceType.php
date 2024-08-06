<?php

namespace App\Models\ServiceType;

use App\Models\Nationality\Nationality;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServiceType extends Model
{
    use HasFactory, Translatable;
    protected $table = 'service_types';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'service_type_id';

    public function nationalities(): BelongsToMany
    {
        return $this->belongsToMany(Nationality::class, 'nationality_types', 'service_type_id', 'nationality_id');
    }
    public function scopeFilter(Builder $builder): Builder
    {
        return $builder;
    }
}
