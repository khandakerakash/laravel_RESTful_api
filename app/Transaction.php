<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'buyer_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
