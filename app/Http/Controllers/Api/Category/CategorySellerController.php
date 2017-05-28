<?php

namespace App\Http\Controllers\Api\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorySellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $categories = $category->with('products.seller')
            ->get()
            ->pluck('products')
            ->collapse()
            ->pluck('seller')
            ->unique('id')
            ->values();

        return $this->showAll($categories, 200);
    }
}
