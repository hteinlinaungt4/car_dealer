<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarView extends Model
{
    use HasFactory;
    protected $fillable=['user_id','car_id'];
}
