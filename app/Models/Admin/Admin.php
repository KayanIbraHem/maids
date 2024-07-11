<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'admins';

    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? asset($this->image) : ''
        );
    }
}
