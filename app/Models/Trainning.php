<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainning extends Model
{
    use HasFactory;
    protected $fillable=['name','description','date'];
}
