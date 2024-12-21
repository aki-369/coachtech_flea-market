<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    // お気に入り商品一覧表示
    public function index()
    {
        $favorites = auth()->user()->favorites;
        return view('favorites.index', compact('favorites'));
    }

    // お気に入り追加処理
    public function store($itemId)
    {
        $user = auth()->user();
        $user->favorites()->create(['item_id' => $itemId]);

        return back()->with('success', 'Item added to favorites');
    }

    // お気に入り削除処理
    public function destroy($itemId)
    {
        auth()->user()->favorites()->where('item_id', $itemId)->delete();
        return back()->with('success', 'Item removed from favorites');
    }
}
