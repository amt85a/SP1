<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends ApiModel
{
    use HasFactory;

    protected $fillable = [
        'beginDate',
        'endingDate',
        'user_id',
        'car_id',
        'status_id',
        'path_id',
        'beginAgency_id',
        'endAgency_id'
    ];
}
