<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerEmail extends Model
{
    use HasFactory;

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}