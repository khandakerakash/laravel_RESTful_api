<?php
/**
 * Created by PhpStorm.
 * User: akash
 * Date: 5/27/17
 * Time: 3:23 PM
 */

namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponse
{

    protected function showAll(Collection $collection, $code) {

        return response()->json(["data" => $collection, "code" => $code], $code);
    }

    protected function showOne(Model $model, $code) {

        return response()->json(["data" => $model, "code" => $code], $code);
    }

    protected function showError($msg, $code) {

        return response()->json(["error" => $msg, "code" => $code]);
    }

}