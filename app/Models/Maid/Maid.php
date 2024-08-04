<?php

namespace App\Models\Maid;

use App\Models\Nationality\Nationality;
use App\Models\ServiceType\ServiceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maid extends Model
{
    use HasFactory;
    protected $table = 'maids';
    protected $guarded = [];
    protected $appen = ['imageLink', 'cvLink'];
    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? asset($this->image) : ''
        );
    }
    public function cvLink(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->cv ? asset($this->cv) : ''
        );
    }
    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }
    public function scopeFilter(Builder $builder): Builder
    {
        return $builder->when(Request::post('word'), function ($query, $word) {
            return $query->where('name', 'LIKE', "%{$word}%")
                ->orwhere('age', 'LIKE', "%{$word}%");
        });
    }
}
