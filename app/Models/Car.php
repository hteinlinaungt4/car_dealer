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
        'featured_image',
        'image1',
        'image2',
        'image3',
        'image4',
        'type',
        'body_color',
        'body_type',
        'company_id',
        'price',
        'number',
        'length',
        'width',
        'height',
        'seating_capacity',
        'fuel_type',
        'displacement',
        'max_power',
        'max_torque',
        'mileage',
        'transmission',
        'no_of_gears',
        'air_conditioning',
        'power_windows',
        'central_locking',
        'abs',
        'air_bags',
        'front_tire',
        'rear_tire',
        'description',
        'fuel_capacity',
        'boot_space',
        'fog_lamps',
        'engine_display',
        'make_year',
        'registration_year',
        'no_of_owners',
        'insurance_type',
        'rto',
        'km_driven',
        'order',
        'view'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
