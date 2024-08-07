<?php

namespace App\Models\Nationality;

use App\Models\ServiceType\ServiceType;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Nationality extends Model
{
    use HasFactory, Translatable;
    protected $table = 'nationalities';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'nationality_id';

    public function serviceTypes(): BelongsToMany
    {
        return $this->belongsToMany(ServiceType::class, 'nationality_types', 'nationality_id', 'service_type_id');
    }
    public function flagLink(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->flag ? asset($this->flag) : ''
        );
    }
    public function scopeSearch(Builder $builder): Builder
    {
        return $builder;
    }
}
