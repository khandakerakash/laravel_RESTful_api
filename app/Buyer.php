<?php

namespace App;

use App\Scopes\BuyerTransactionScope;
use Illuminate\Database\Eloquent\Model;

class Buyer extends User
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BuyerTransactionScope());
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
