<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refferal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function inviteds()
    {
        return $this->belongsTo(User::class, 'invited');
    }
}
