<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Code extends Controller
{
    public static function generate()
    {
        $character = "1234567890ABCDEFGHIJKLMNOPQRSTUVWYZ";
        $code = "";

        for ($i = 0; $i < 10; $i++) {
            $code .= $character[rand(0, strlen($character) - 1)];
        }

        return $code;
    }
}
