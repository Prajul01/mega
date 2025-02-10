<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayPackage extends Model
{
    use HasFactory;

    public function prices(){
        return $this->hasMany(AdPricing::class)->with('package');
    }
}
