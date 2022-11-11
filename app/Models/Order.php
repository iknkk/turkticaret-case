<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
