<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Models\Notification as ModelsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class Notification extends Controller
{
    public static function create($header, $content)
    {
        ModelsNotification::create([
            'user_id' => Cookie::get('id'),
            'header' => $header,
            'content' => $content
        ]);
    }
}
