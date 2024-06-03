<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'product_id', 'client_name', 'phone_number', ,'email','brief', 'budget', 'appointment_date', 'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
