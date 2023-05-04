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
use Illuminate\Contracts\Auth\CanResetPassword;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements CanResetPassword
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
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

    public static function boot()
{
    parent::boot();
    static::deleting(function($obj) {
        Storage::delete(Str::replaceFirst('storage/','public/', $obj->image));
    });
}



public function setImageAttribute($value)
{
    $attribute_name = "avatar_path";
    // destination path relative to the disk above
    $destination_path = "public/avaters";

    // if the image was erased
    if ($value==null) {
        // delete the image from disk
        Storage::delete($this->{$attribute_name});

        // set null in the database column
        $this->attributes[$attribute_name] = null;
    }

    // if a base64 was sent, store it in the db
    if (Str::startsWith($value, 'data:image'))
    {
        // 0. Make the image
        $image = Image::make($value)->encode('jpg', 90);

        // 1. Generate a filename.
        $filename = md5($value.time()).'.jpg';

        // 2. Store the image on disk.
        Storage::put($destination_path.'/'.$filename, $image->stream());

        // 3. Delete the previous image, if there was one.
        Storage::delete(Str::replaceFirst('storage/','public/', $this->{$attribute_name}));

        // 4. Save the public path to the database
        // but first, remove "public/" from the path, since we're pointing to it
        // from the root folder; that way, what gets saved in the db
        // is the public URL (everything that comes after the domain name)
        $public_destination_path = Str::replaceFirst('public/', 'storage/', $destination_path);
        $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
    }


}
public function getProfileImage()
    {
        return $this->avatar_path ? $this->avatar_path : asset('images/user.png');
    }
}
