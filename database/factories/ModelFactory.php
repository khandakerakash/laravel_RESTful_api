<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Buyer;
use App\Category;
use App\Product;
use App\Seller;
use App\Transaction;
use App\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'verified' => $tokenStatus = $faker->randomElement([User::USER_VERIFIED, User::USER_UNVERIFIED]),
        'verification_token' => $tokenStatus == User::USER_VERIFIED ? User::generateVerifiedToken() : null,
        'admin' => $faker->randomElement([User::ADMIN_USER, User::REGULAR_USER]),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker-> word,
        'description' => $faker-> sentence(20),
    ];
});

$factory->define(Product::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker-> word,
        'description' => $faker-> sentence(100),
        'image' => $faker-> randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg']),
        'seller_id' => User::all()->random(1)->first()->id,
        'price' => $faker-> randomFloat(2, 10, 1000),
    ];
});

$factory->define(Transaction::class, function (Faker\Generator $faker) {

    $seller = Seller::has('products')->get()->random(1)->first();
    $product = $seller->products->random(1)->first();
    $buyer = Buyer::all()->except($seller->id)->random(1)->first();

    return [
        'buyer_id' => $buyer->id,
        'product_id' => $product->id,
        'quantity' => $faker-> numberBetween(1, 10),
        'price' => $product->price,
    ];
});

