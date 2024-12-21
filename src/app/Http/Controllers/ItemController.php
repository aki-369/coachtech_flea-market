<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    // 商品一覧表示
    public function index()
    {
        $items = Item::all();
        return view('index', compact('items'));
    }

    // 商品詳細表示
    public function show($itemId)
    {
        $item = Item::findOrFail($itemId);
        return view('items.show', compact('item'));
    }

    // 商品出品フォームの表示
    public function showSellForm()
    {
        return view('items.sell');
    }

    // 商品出品処理
    public function sell(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image_url' => 'nullable|url',
        ]);

        $item = Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => Auth::id(),
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('items.show', ['itemId' => $item->id]);
    }

    // 商品のお気に入り追加
    public function addToFavorites($itemId)
    {
        $item = Item::findOrFail($itemId);
        Auth::user()->favorites()->create([
            'item_id' => $item->id
        ]);

        return back()->with('success', 'Item added to favorites');
    }

    // 商品のお気に入り削除
    public function removeFromFavorites($itemId)
    {
        $item = Item::findOrFail($itemId);
        Auth::user()->favorites()->where('item_id', $item->id)->delete();

        return back()->with('success', 'Item removed from favorites');
    }
}
