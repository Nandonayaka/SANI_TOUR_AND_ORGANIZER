<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_name', 
        'customer_phone', 
        'schedule_id', 
        'total_persons', 
        'total_price', 
        'status'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
