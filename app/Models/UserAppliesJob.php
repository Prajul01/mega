<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAppliesJob extends Model
{
    use HasFactory;

    public $timestamps = false;
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
