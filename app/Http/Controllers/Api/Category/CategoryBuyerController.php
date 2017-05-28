<?php

namespace App\Http\Controllers\Api\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $buyers = $category->with([
            'products' => function ($query) {
                $query->with('transactions.buyer');
            }
        ])
            ->get()
            ->pluck('products')
            ->collapse()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values()
            ->filter(function ($item) {
                return $item->verified == 1;
            });

        return $this->showAll($buyers, 200);
    }
}
