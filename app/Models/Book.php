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

    protected $fillable = ['name','email','phone','car_id','message','status','user_id','invoices'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'book_id');
    }



}
