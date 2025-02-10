<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSavesJobs extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
