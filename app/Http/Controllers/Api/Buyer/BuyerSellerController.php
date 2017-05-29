<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Buyer $buyer
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()->with('product.seller')
            ->get()
            ->pluck('product')
            ->pluck('seller')
            ->unique('id')
            ->values()
            ->filter(function ($item) {
                return $item->verified == 1;
            });

        return $this->showAll($sellers, 200);
    }
}
