<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    use HasFactory;


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
    public function stylist()
    {
        return $this->belongsTo(User::class, 'stylist_id');
    }

    /**
     * The customer that this booking belongs to
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
