<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        "type",
        "employment",
        "hrsWeek",
        "weekDays",
        "firstName",
        "lastName",
        "dob",
        "email",
        "phone",
        "address",
        "zip",
        "city",
        "education1",
        "education2",
        "education3",
        "exp1",
        "exp2",
        "exp3",
        "motivation"
    ];

    protected $casts=[
        // "weekDays"=>'array',
        "dob"=>'datetime',
    ];
}
