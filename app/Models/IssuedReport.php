<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedReport extends Model
{
    use HasFactory;

    public function concern(){
        return $this->belongsTo(AreaOfConcern::class, 'area_of_concern_id');
    }
}
