<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
