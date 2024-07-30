<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'user_devices';

    public function deviceable()
    {
        return $this->morphTo();
    }
}
