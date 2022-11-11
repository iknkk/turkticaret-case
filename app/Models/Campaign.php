<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    public function orders($campaignID)
    {
        return $this->hasMany(Order::class)->where('campaign_id', $campaignID);
    }
}
