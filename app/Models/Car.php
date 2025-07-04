<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'model',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'type',
        'body_color',
        'company_id',
        'price',
        'number',
        'fuel_type',
        'mileage',
        'transmission',
        'description',
        'max_power',
        'position',
        'view',
        'status',

    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
