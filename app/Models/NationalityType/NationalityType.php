<?php

namespace App\Models\NationalityType;

use App\Models\Nationality\Nationality;
use App\Models\ServiceType\ServiceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NationalityType extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "nationality_types";

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'nationality_id', 'id');
    }

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id', 'id');
    }
}
