<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\PhoneStatus;
use App\Models\User\UserDevice;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = 'users';
    protected $append = ['imageLink'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'country_code',
        'image',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? asset($this->image) : ''
        );
    }
    public function userDevices(): MorphMany
    {
        return $this->morphMany(UserDevice::class, 'deviceable');
    }
    public static function checkPhone(string $phone): bool
    {
        return self::where('phone', $phone)->exists();
    }
    public static function verifyPhone(string $phone): bool
    {
        return self::where('phone', $phone)->update(['is_phone_verified' => PhoneStatus::VERIFIED->value]);
    }
    public function scopeFilter(Builder $builder): Builder
    {
        return $builder;
    }
}
