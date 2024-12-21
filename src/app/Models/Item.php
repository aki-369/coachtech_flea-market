<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'user_id',
        'image_url',
    ];

    // 商品を出品したユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 商品のお気に入り
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // 商品の購入履歴
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // 商品のコメント
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
