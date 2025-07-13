<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'book_id',
        'salesperson_name',
        'buyer_name',
        'buyer_email',
        'total_amount',
        'confirmed_at',
        'payment_type',
    ];


    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }



}
