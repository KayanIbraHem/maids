<?php

namespace App\Models\Maid;

use App\Models\Nationality\Nationality;
use App\Models\ServiceType\ServiceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maid extends Model
{
    use HasFactory;
    protected $table = 'maids';
    protected $guarded = [];
    protected $appen = ['imageLink', 'cvLink'];

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }
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
}
