<?php

namespace App\Models\Admin;

use App\Enums\AdminType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'admins';
    protected $append = ['imageLink'];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value;
    }
    public function isNotSuperAdmin()
    {
        return $this->type != AdminType::SUPER_ADMIN->value;
    }
    public function scopeNotSuperAdmin(Builder $builder): Builder
    {
        return $builder->where('type', '!=', AdminType::SUPER_ADMIN->value);
    }
    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? asset($this->image) : ''
        );
    }
    public function scopeSearch(Builder $builder): Builder
    {
        return $builder;
    }
    protected function hashPassword()
    {
        if (Hash::needsRehash($this->attributes['password'])) {
            $this->attributes['password'] = Hash::make($this->attributes['password']);
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            $admin->hashPassword();
        });

        static::updating(function ($admin) {
            if ($admin->isDirty('password')) {
                $admin->hashPassword();
            }
        });
    }
}
