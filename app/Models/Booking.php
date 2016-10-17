<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function setDateAttribute($value)
    {
        return $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }

    public function getDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
