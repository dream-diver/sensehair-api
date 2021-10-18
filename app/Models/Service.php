<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * Returns Service's path
     *
     * @return string
     */
    public function path()
    {
        return '/api/services/' . $this->id;
    }

    /**
     * The users that belong to the service.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'service_user', 'service_id', 'user_id')
                    ->withPivot('stylist_charge')
                    ->withTimestamps();
    }
}
