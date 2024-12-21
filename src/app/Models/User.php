<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ユーザーが出品した商品
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // ユーザーのお気に入り
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // ユーザーの購入履歴
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // ユーザーのコメント
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
