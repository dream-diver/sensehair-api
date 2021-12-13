<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [
        // 'name',
        // 'email',
        // 'password',
        // 'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns Users's path
     *
     * @return string
     */
    public function path()
    {
        return '/api/users/' . $this->id;
    }

    /**
     * The services that belong to the user.
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_user', 'user_id', 'service_id')
                    ->withPivot('stylist_charge')
                    ->withTimestamps();
    }

    /**
     * The bookings that belong to the user.
     */
    public function bookings()
    {
        if ($this->hasRole(['stylist', 'art_director'])) {
            return $this->hasMany(Booking::class, 'server_id');
        } else if ($this->hasRole('customer')) {
            return $this->hasMany(Booking::class, 'customer_id');
        }
    }

    public function routeNotificationForTwilio()
    {
        return $this->phone;
    }
}
