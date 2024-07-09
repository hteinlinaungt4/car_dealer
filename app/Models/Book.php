<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    protected $fillable = ['name','email','phone','car_id','message','status'];
}
