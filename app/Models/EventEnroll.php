<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventEnroll extends Model
{
    use HasFactory;
    protected $table='trainning_enrolls';
    protected $fillable=['name','email','mobile','event_id'];
}
