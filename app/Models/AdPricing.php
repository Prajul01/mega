<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdPricing extends Model
{
    use HasFactory;

    public function package(){
        return $this->belongsTo(DayPackage::class, 'day_package_id');
    }
}
