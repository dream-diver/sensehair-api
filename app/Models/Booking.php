<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'booking_time' => 'datetime',
    ];

    /**
     * Returns Bookings's path
     *
     * @return string
     */
    public function path()
    {
        return '/api/bookings/' . $this->id;
    }

    /**
     * The stylist that this booking belongs to
     */
    public function server()
    {
        return $this->belongsTo(User::class, 'server_id');
    }

    /**
     * The customer that this booking belongs to
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * All the Services that this booking has
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }


    /**
     * The promocode that was used in this booking
     */
    public function promocode()
    {
        return $this->belongsTo(Promocode::class, 'promocode_id');
    }
}
