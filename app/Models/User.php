<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function balance()
    {
        return $this->hasMany(Balance::class);
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }

    public function refferal()
    {
        return $this->hasMany(Refferal::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function withdraw()
    {
        return $this->hasMany(Withdraw::class);
    }

    public function testimoni()
    {
        return $this->hasMany(Testimoni::class);
    }

    public function profit()
    {
        return $this->hasMany(Profit::class);
    }

    public function investment()
    {
        return $this->hasMany(Investment::class);
    }
}
