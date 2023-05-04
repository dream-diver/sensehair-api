<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
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
     * All the bookings that used this promocode
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Returns Promocode's path
     *
     * @return string
     */
    public function path()
    {
        return '/api/promocodes/' . $this->id;
    }
}
