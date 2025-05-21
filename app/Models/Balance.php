<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Balance extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getByUser()
    {
        return Balance::where('user_id', Cookie::get('id'))->get();
    }
}
