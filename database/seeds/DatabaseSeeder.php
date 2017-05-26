<?php

use App\Category;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

//        DB::statement('SET FOREIGN_KEY_CHECKS=0');
//
//        $table = [
//            'users',
//            'categories',
//            'products',
//            'transactions',
//            'category_product'
//        ];
//
//        foreach ($table as $item) {
//            DB::table($item)->truncate();
//        }
//
//
//        DB::statement('SET FOREIGN_KEY_CHECKS=1');
//
//        factory(User::class, 200)->create();
//
//        factory(Category::class, 30)->create();
//        factory(Product::class, 500)->create()->each(function ($product ) {
//            $categories = Category::all()->random(mt_rand(1,6))->pluck('id');
//            $product->categories()->attach($categories);
//        });

        factory(Transaction::class, 500)->create();
    }
}
