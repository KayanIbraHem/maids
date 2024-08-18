<?php

namespace App\Models\Slider;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'sliders';
    protected $append = ['imageLink'];

    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image ? asset($this->image) : ''
        );
    }
}
